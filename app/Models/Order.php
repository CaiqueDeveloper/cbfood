<?php

namespace App\Models;

use DatePeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['company_id','user_id','address_id', 'payment_method', 'delivery_price', 'price_total', 'thing'];

    public function orderProduct(){
       
        return $this->hasMany(OrderProduct::class, 'orders_id');
    }
    public function orderUser(){
       
        return $this->hasMany(User::class,'id', 'user_id');
    }

    protected static function getOrders(){

        $company_id = Auth::user()->company_id;
        return Order::where('company_id',$company_id)->with('orderProduct.productOrder','orderUser')->orderBy('orders.created_at', 'desc')->get();
    }
    protected static function getOrder($id){
        return Order::where('id', $id)->with('orderProduct.productOrder','orderUser')->orderBy('orders.created_at', 'desc')->get();
    }
    public static function storageOrderUser($orders, $paymentMethod,$thing, $address){
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
        $orderUser['thing'] = $thing['thing'];
        $orderUser['price_total'] = \Cart::getTotal();

        $orderInsert = Order::create($orderUser);
        $storageOrderProduct =  OrderProduct::storageOrderProduct($orderInsert->id, $orders);

        return true;
    }

    public static function getDataGraphSales($start, $interval, $end){
        
        $data = [];
        $daterange_actual = new DatePeriod($start, $interval, $end->modify('+1 day'));
        foreach($daterange_actual as $key_actual => $day_actual){
            $data[] = ["day" => $day_actual->format('d/m'), "sales" => '0', "cancel_sales" => 0,'last_day' => $day_actual->modify('-1 month')->format('d/m'), "last_sales" => 0,"last_canceled_sales" => 0];
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
                    }else{
                        $data[$key]['last_canceled_sales'] += $order_last->price_total;
                    }
                }
            }
        }

        return $data;
    }
    public static function exportOrderUser($id){
        
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
        return $auxOrder;
    }
    public static function getDataIndicatorsDashboard($start, $end){

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
}
