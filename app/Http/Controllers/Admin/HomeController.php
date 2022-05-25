<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
    
        return view('panel.index');
    }
    protected function getAllOrdersCompany(){

        $company = Company::find(Auth::user()->company_id);
        $orders = $company->orders;
        return response()->json($orders);
    }
}
