<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenancyRegisterController extends Controller
{

    public function tenancyRegister(Request $request)
    {
        // dd("Tenancy Register");
        return view('tenant.tenancy-register');
    }
    public function postRegister(Request $request)
    {
        // company, domain, name,email,password,password_confirmation
        // dd("Tenancy Register");

        $all = $request->all();
        // dd($all);
        return "Successfully Created the Domain";
    }

    public function subscription(Request $request)
    {
        return view('subscription');
    }

    public function PermissionSubscription(Request $request)
    {
        return "sdfsaf";
    }
    
}
