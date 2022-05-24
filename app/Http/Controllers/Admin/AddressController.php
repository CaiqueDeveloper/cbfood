<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function storageAddress($id, $data){
        
        return Address::storageAddressUser($id, $data);
    }
}
