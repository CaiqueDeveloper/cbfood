<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct() {
    
        $this->middleware('auth');
   }
    public function import(){
        return view('panel.report.index');
    }
    public function processingReport(Request $request){
        
        Excel::import(new ProductImport, request()->file('file'));
    }
}
