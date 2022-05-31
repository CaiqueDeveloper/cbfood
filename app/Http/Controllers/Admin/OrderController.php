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
    public function getOredsUser($orders, $paymentMethod, $address){
        $address_id = 0;
        $auxOrder = $orders->first();
        $payment = '';
        if(isset($paymentMethod['money'])){
            $payment = $paymentMethod['money'];
        }else{
                $payment = $paymentMethod['credcard'];
        }
        if(isset($address['address'])){
            $address_id = $address['address'];
        }else{
            $address_id = $address;
        }
        $orderUser =  [];
        $orderUser['company_id'] = $auxOrder->attributes->company_id;
        $orderUser['user_id'] = Auth::user()->id;
        $orderUser['address_id'] = $address_id;
        $orderUser['payment_method'] = $payment;
        $orderUser['delivery_price'] = 0;
        $orderUser['price_total'] = \Cart::getTotal();
        $orderInsert = Order::create($orderUser);

        $additional_id = '';
        foreach($orders as  $order){
            if(sizeof($order->attributes->additionalsIds) > 0){
                    $additional_id = implode(',', $order->attributes->additionalsIds);
            }
            OrderProduct::insert([
                'orders_id' => $orderInsert->id,
                'products_id' => $order->attributes->product_id,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'sizeText' => ($order->attributes->sizeText != null) ? $order->attributes->sizeText : "",
                'additional_id' => (sizeof($order->attributes->additionalsIds) > 0) ? $additional_id : '',
                'observation' => $order->attributes->observation,
            ]);
        }
       \Cart::clear();
       return true;
    }   
    public function getDataIdicatorOrders($start, $end){
        $start = new DateTime($start);
        $end = new DateTime($end);
        $orders = Order::where('company_id',Auth::user()->company_id)
        ->whereBetween('created_at', [$start, $end->modify('+1 day')])
        ->get();

        $revenue = 0;
        $orderConfirmed = 0;
        $orderCanceled = 0;
        $oderTotal = sizeof($orders);
        foreach($orders as $key => $value){
            if($value->status != 0){
                $revenue += $value->price_total;
            }
            if($value->status == 5){
                $orderConfirmed ++;
            }
            if($value->status == 0){
                $orderCanceled++;
            }
        }
        return [
            'revenue' => 'R$ '.number_format($revenue,2,",","."),
            'orderConfirmed'=> $orderConfirmed,
            'orderCanceled'=> $orderCanceled,
            'oderTotal'=> $oderTotal,
        ];
    }
    public function getDataGraphSales($start, $end){

        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        
        $data = [];
        $daterange_actual = new DatePeriod($start, $interval, $end->modify('+1 day'));
        foreach($daterange_actual as $key_actual => $day_actual){
            $data[] = ["day" => $day_actual->format('d/m'), "sales" => '0', "cancel_sales" => 0,'last_day' => $day_actual->modify('-1 month')->format('d/m'), "last_sales" => 0];
        }

        $orders_actual = Order::where('company_id',Auth::user()->company_id)
        ->whereBetween('created_at', [$start, $end])
        ->get();

        $orders_last = Order::where('company_id',Auth::user()->company_id)
        ->whereBetween('created_at', [$start->modify('-1 month'), $end->modify('-1 month')])
        ->get();

        foreach($data as $key => $d){
            foreach($orders_actual as $key_order_actual => $order_actual){
                if($d['day'] == $order_actual->created_at->format('d/m')){
                    if($order_actual->status != 0){
                        $data[$key]['sales'] += $order_actual->price_total;
                    }else{
                        $data[$key]['cancel_sales'] += $order_actual->price_total;
                    }
                }
            }
            foreach($orders_last as $key_order_last => $order_last){
                if($d['last_day'] == $order_last->created_at->format('d/m')){
                    if($order_last->status !== 0){
                        $data[$key]['last_sales'] += $order_last->price_total;
                    }
                }
            }
        }
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
        $order = Order::getOrder($id);
        $auxOrder = [];
        $auxOrder['orderCod'] = $order[0]->id;
        $auxOrder['orderUser'] = User::where('id',$order[0]->user_id)->select('name','number_phone')->get();
        $auxOrder['orderQtItem'] = count(OrderProduct::where('orders_id', $order[0]->id)->get());
        $auxOrder['orderPaymentMethod'] = ($order[0]->payment_method != 'credcard') ? 'Dinheiro' : 'Cartão de Crédito';
        $auxOrder['orderTotalPrice'] = 'R$ '.number_format($order[0]->price_total,2,",",".");
        $auxOrder['orderThing'] = ($order[0]->thing != null) ? 'R$ '.number_format($order[0]->thing,2,",",".") : 'VALOR NÃO ESPECIFICADO';
        $auxOrder['orderDate'] = date('d/m/Y', strtotime($order[0]->created_at));
        $auxOrder['orderAddressUser'] = Address::find($order[0]->address_id);
        foreach(OrderProduct::where('orders_id', $order[0]->id)->get() as $key => $value){

            $value->additional = AdditionalItems::whereIn('id',explode(',',$value->additional_id))->get();
            $auxOrder['orderItem'][] = $value;
        }
        //$pdf = \PDF::loadView('panel.orders.exportOrder', ['auxOrder'=> $auxOrder]);
        return view('panel.orders.exportOrder', compact('auxOrder'));
        return $pdf->download('cbfood-Order.pdf');

    }
}
