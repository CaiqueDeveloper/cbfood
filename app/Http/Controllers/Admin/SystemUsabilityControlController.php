<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemUsabilityControlController extends Controller
{
    public function index(){
        $modules = Module::where('hasModules', 1)
        ->get();
        $companiesUser = Auth()->user()->companies()->where('status', 1)->get();
        return view('panel.systemUsabilityControl.index', compact('modules', 'companiesUser'));
    }
}
