<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
    
        return view('panel.index');
    }
    protected function getIdicatorsDashboard(Request $request){
        
        return response()->json(OrderController::getDataIdicatorOrders($request->start, $request->end));
    }
    protected function getDataGraphSales(Request $request){
        return response()->json(OrderController::getDataGraphSales($request->start, $request->end));
    }
    protected function allSalesByCategories(Request $request){
        return response()->json(OrderController::allSalesByCategories($request->start, $request->end));
    }
    
}
