<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('Admin.User.manage-user');
    }
    
    public function create()
    {
        return view('Admin.User.add-user')->with('roles', \App\Role::all());
    }

    public function store(\App\Http\Requests\StoreUserRequest $request)
    {
        $request->validated();
        $request['password'] = Hash::make($request->password);
        $user = \App\User::create(array_merge($request->all(), ['index' => 'value']));
        $user->roles()->attach($request->role);
        return redirect()->back()->with('success','User Created');
    }

   
}
