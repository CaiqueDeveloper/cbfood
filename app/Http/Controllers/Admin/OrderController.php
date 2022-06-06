<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\AdditionalItems;
use App\Models\Address;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Notifications\NotifyTheCompanyOfTheUsersRequest;
use Barryvdh\DomPDF\PDF;
use Darryldecode\Cart\Cart;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orders(){
        return view('panel.orders.index');
    }
    public function delivered(){
        return view('panel.orders.delivered');
    }
    public function beingPrepared(){
        return view('panel.orders.beingPrepared');
    }
    public function canceled(){
        return view('panel.orders.canceled');
    }
    public function getOredsUser($orders, $paymentMethod,$thing, $pickUpOnTheSpot,$address){

       $storageOrder = Order::storageOrderUser($orders, $paymentMethod,$thing,$pickUpOnTheSpot, $address);
        if($storageOrder){

            \Cart::clear();
            return true;
        }
       
    }   
    public function getDataIdicatorOrders($start, $end){

        $start = new DateTime($start);
        $end = new DateTime($end);
        
        return Order::getDataIndicatorsDashboard($start, $end);
    }
    public function getDataGraphSales($start, $end){

        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        
        $data = Order::getDataGraphSales($start, $interval, $end);
        return response()->json($data);  
    }

    public function getOrders(){

        return response()->json(Order::getOrders(), 200);
    }
    protected function updateStatusOrder(Request $request){

        if(Order::where('id', $request->order_id)->update($request->except('order_id'))){
            return response()->json('success', 200);
        }else{
            return response()->json('error', 500);
        }
       
    }
    protected function showModalAddressOrderUser($id){
        $addressOrderuser = Address::find($id);
        return view('panel.modals.orders.modalAddressOrderUser', compact('addressOrderuser'));
    }
    protected function showModalGerAdditionalOrders(Request $request){
        $additionalItems = AdditionalItems::whereIn('id',explode(',',$request->id))->get();
        return view('panel.modals.orders.modaladditionalItems', compact('additionalItems'));
    }
    protected function exportOrder($id){

        $auxOrder = Order::exportOrderUser($id);
        return view('panel.orders.exportOrder', compact('auxOrder'));

    }
}
