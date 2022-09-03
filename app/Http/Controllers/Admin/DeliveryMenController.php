<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderDeliveryman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryMenController extends Controller
{
    public function __construct() {
    
        $this->middleware('auth');
    }
    public function index(){

        return view('panel.deliverymen.index');
    }
    protected function showModalGeteDelirevyMen($id){
        
       $deliverymen = Company::find(auth()->user()->company_id)->user()->with('profiles')->get();
       return view('panel.modals.deliverymen.modalGeteDelirevyMen', compact('deliverymen', 'id'));
    }

    protected function sendOrderToDeliveryPerson(Request $request){
        if(OrderDeliveryman::create($request->all())){
            return response()->json('Parabéns Permissão cadastrada com sucesso!', 200);
        }else{
            return response()->json('Erro ao  Cadastrar a Pemissão.', 500);
        }
    }
    public function getOrdersDeliveryMen(){

        return response()->json(Order::getOrdersDeliveryMen(), 200);
    }
    protected function getRederIdicatorsDeliveryMen(){
        $myDeliveries = User::find(auth()->user()->id);
        return [
            'totalDeliveries' => $myDeliveries->ordersDeliverymen()->where('status', 0)->count(),
            'totalNewDeliveries' => $myDeliveries->ordersDeliverymen()->where('status', 1)->count(),
        ];
    }
}
