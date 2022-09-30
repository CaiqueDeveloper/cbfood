<?php

namespace App\Models;

use App\Events\NotifyTheCompanySalesTheRequstUser;
use App\Http\Controllers\Admin\SendNotificationFCMController;
use App\Notifications\NotifyTheCompanyOfTheUsersRequest;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'orders';
    protected $fillable = ['company_id','user_id','day','address_id', 'payment_method', 'delivery_price', 'price_total', 'thing','pickUpOnTheSpot', 'status'];

    public function orderProduct(){
       
        return $this->hasMany(OrderProduct::class, 'orders_id');
    }
    public function orderUser(){
       
        return $this->hasMany(User::class,'id', 'user_id');
    }
    public function orderAddress(){
        return $this->belongsTo(Address::class,'address_id', 'addres_morph_id');
    }
    public function orderCompany(){
       
        return $this->hasMany(User::class,'id', 'company_id');
    }
    
    protected static function getOrders($start = null, $end = null){
        
      
        if($start == null && $end == null){
            $start = new DateTime('first day of this month');
            $end = new DateTime('last day of this month');
        }

        $start = new DateTime($start);
        $end = new DateTime($end);

        $company_id = Auth::user()->company_id;
        return Order::where('company_id',$company_id)->with('orderProduct.productOrder','orderUser')
        ->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])
        ->orderBy('orders.day', 'desc')
        ->get();
    }
    protected static function getOrdersDeliveryMen(){

        $myDeliveries = User::find(auth()->user()->id);
        return Order::whereIn('id', array_column($myDeliveries->ordersDeliverymen->toArray(),'order_id'))->with('orderProduct.productOrder','orderUser')->orderBy('orders.day', 'desc')->get();
    }
    protected static function getOrder($id){
        return Order::where('id', $id)->with('orderProduct.productOrder','orderUser')->orderBy('orders.day', 'desc')->get();
    }
    public static function storageOrderUser($orders, $paymentMethod,$thing,$pickUpOnTheSpot, $address){
        
        $address_id = 0;
        $auxOrder = $orders->first();
        $payment = '';
        $deliveryPrice = 0;

        if(isset($paymentMethod['payment_method'])){
            $payment = $paymentMethod['payment_method'];
        }else{
                $payment = $paymentMethod['payment_method'];
        }
        if(isset($address['address'])){
            $address_id = $address['address'];
        }else{
            $address_id = $address;
        }
       
            
        if($pickUpOnTheSpot['pick_up_on_the_spot'] == 'não'){
            $company = Company::where('id', $auxOrder->attributes->company_id)->get();
            $deliveryPrice =  $company[0]->settings[0]->deliveryPrice;
        }else{
            $deliveryPrice = 0;
        }

        $orderUser =  [];
        $nofityCompany =  [];
        $orderUser['company_id'] = $auxOrder->attributes->company_id;
        $orderUser['user_id'] = Auth::user()->id;
        $orderUser['day'] = date('Y-m-d');
        $orderUser['address_id'] = $address_id;
        $orderUser['payment_method'] = $payment;
        $orderUser['delivery_price'] = $deliveryPrice;
        $orderUser['thing'] = $thing['thing'];
        $orderUser['pickUpOnTheSpot'] = $pickUpOnTheSpot['pick_up_on_the_spot'];
        $orderUser['price_total'] = \Cart::getTotal();
        $orderUser['status'] = 1;
        $phone = Company::find($auxOrder->attributes->company_id)->value('phone_number');
        $orderInsert = Order::create($orderUser);
        
        $storageOrderProduct =  OrderProduct::storageOrderProduct($orderInsert->id, $orders);
        $company = $orderInsert->orderCompany;
        Notification::send($company,new NotifyTheCompanyOfTheUsersRequest($orderInsert));
        event(new NotifyTheCompanySalesTheRequstUser($orderInsert));
       
        return response()->json(self::formatSentMenssageWhatAppUser(self::exportOrderUser($orderInsert->id), $phone), 200);
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
    public function allSalesByCategories($start, $interval, $end){
       
        return Order::where('company_id', auth()->user()->company_id)
        ->whereBetween('orders.created_at', [$start, $end])
        ->join('order_products', 'order_products.orders_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_products.products_id')
        ->join('categories', 'categories.id','=', 'products.category_id')
        ->select('categories.name',DB::raw('count(*) as total'))
        ->groupBy('categories.name')
        ->get();
       
    }
    public function getDataGraphSalesStatus($start, $interval,$end){
       
        $orders = Order::where('company_id', auth()->user()->company_id)
        ->whereBetween('orders.day', [$start, $end])
        ->select('orders.status',DB::raw('count(*) as total'))
        ->groupBy('orders.status')
        ->get();

        $data = [];
        foreach($orders as $key => $or){
            switch($or->status){
                case "0":
                   $status_name = 'Cancelado</p>';   
                break;
                case "1":
                   $status_name = 'Novo';   
                break;
                case "2":
                   $status_name = 'Recebido';    
                break;
                case "3":
                   $status_name = 'Sendo Preparado';   
                break;
                case "4":
                   $status_name = 'Saiu Para Entrega';    
                break;
                case "5":
                   $status_name = 'Entregue';    
                break;
                default:
                    $status_name = "Status não definido";
                break;
            }
            
            $data[$key]['total'] = $or->total;
            $data[$key]['name'] = $status_name;
        }
        return $data;
       
    }
    public function getDataShowingTop10SellingProducts($start, $interval, $end){
       
        $data = Order::where('company_id', auth()->user()->company_id)
        ->whereBetween('orders.created_at', [$start, $end])
        ->join('order_products', 'order_products.orders_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_products.products_id')
        ->join('categories', 'categories.id','=', 'products.category_id')
        ->select('products.name','categories.name as category',DB::raw('sum(order_products.quantity) as total, order_products.price * sum(order_products.quantity) as totalBilling'))
        ->groupBy('products.name')
        ->limit(10)
        ->get();
        
        return $data;
    }
    public function getDataTableSalesDay($start, $interval, $end){
       
        $data = Order::where('company_id', auth()->user()->company_id)
        ->whereBetween('orders.created_at', [$start, $end])
        ->join('order_products', 'order_products.orders_id', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'order_products.products_id')
        ->join('categories', 'categories.id','=', 'products.category_id')
        ->select('products.name','categories.name as category','order_products.price', 'order_products.quantity as total')
        ->get();

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
    protected static function changeStateOrderUser($order_id, $status){
        
        $order = Order::where('id', $order_id)->get();
        $user = User::getUserOrder($order[0]->user_id);
        $company = Company::getCompanyOrder($order[0]->company_id);
        $order[0]->status = $status;
        
        
        if($order[0]->save()){
            $user = $order[0]->orderUser;
            Notification::send($user,new NotifyTheCompanyOfTheUsersRequest($order[0]));
            event(new NotifyTheCompanySalesTheRequstUser($order[0]));
            return [
                'user' => $user,
                'company' => $company,
                'status_order' => $status,
            ];
            
        }
    }
    protected static function formatSentMenssageWhatAppUser($data, $phone){

        $response = [];
        $response['message']['whatapp'] =  preg_replace("/[^\d]/", "", $phone);
        $response['message']['cod'] = $data['orderCod'];
        $response['message']['client'] = $data['orderUser'][0]['name'];
        $response['message']['phone'] =  $data['orderUser'][0]['number_phone'];
        $response['message']['dateSolicitation'] = $data['orderDate'];
        $response['message']['priceOrder'] = $data['orderTotalPrice'];
        $response['message']['paymentMethod'] = $data['orderPaymentMethod'];
        $response['message']['thing'] = $data['orderPaymentMethod'];
        $response['message']['paymentMethod'] = $data['orderQtItem'];
        foreach($data['orderItem'] as $item){
            foreach($item->productOrder as $prod){
                $response['message']['products'][] = $prod->name;
                if(count($item['additional']) > 0){
                    foreach($item['additional'] as $additional){
                        $response['message']['additionals'][] = $additional->name;
                    }
                }else{
                    $response['message']['additionals'][] = 'Não especificado';
                }
            }
        }
        $response['message']['address']['road'] = $data['orderAddressUser']->road;
        $response['message']['address']['distric'] = $data['orderAddressUser']->distric;
        $response['message']['address']['number'] = $data['orderAddressUser']->number;
        $response['message']['address']['city'] = $data['orderAddressUser']->city;
        $response['message']['address']['zipe_code'] = $data['orderAddressUser']->zipe_code;
        $response['message']['address']['states'] = $data['orderAddressUser']->states;
        $response['message']['address']['complement'] = $data['orderAddressUser']->complement;
        return $response;
    }
}
