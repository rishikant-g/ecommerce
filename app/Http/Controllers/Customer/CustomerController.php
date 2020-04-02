<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Role;

class CustomerController extends Controller
{
    public function index()
    {
        return view('Customer.register-customer');
    }

    public function store(\App\Http\Requests\RegisterCustomerRequest $request)
    {
        $request->validated();
        try{

       $request['password'] = Hash::make($request->password);
       $user = \App\User::create(array_merge($request->all(), ['index' => 'value']));
       $role= Role::where(['role_name' => 'customer'])->select('id')->get();
       $user->roles()->attach($role);
       return redirect()->route('login')->with('success','User created');
        }
        catch(\Exception $ex){
            dd($ex);
        }
    }
}
