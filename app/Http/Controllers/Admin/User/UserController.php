<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\User;
use App\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('customer');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/edit/'.$row->id.'/user"><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;<i class="fas fa-trash-alt delete-user" data-id="'.$row->id.'"></i>';

                    return $btn;
                })
                ->addColumn('role',function($user){
                    $user_role = '';
                    foreach($user->roles as $role){
                        $user_role .=$role->role_name;
                    }
                    return $user_role;
                })
                ->rawColumns(['role','action'])
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

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user_role ='';
        foreach($user->roles as $role){
            $user_role = $role->role_name; 
        }
        return view('Admin.User.edit-user')->with('user',$user)->with('user_role',$user_role)->with('roles',Role::all());
    }

    public function deleteUser(Request $request)
    {
        try{
            $user = \App\User::findOrFail($request->id);
            $user->delete();
            $user->roles()->detach($request->role);
            return response()->json(["status" => true, "message" => "User delted"]);
        }
        catch(Exception $ex){
            return response()->json(["status" => false, "message" => "User not found"]);
        }
    }

    public function update(Request $request,$id)
    {
        $user = User::findOrFail($id);
        try{
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->status = $request->status;
            $user->save();
            $user->roles()->sync($request->role);
            return redirect()->back()->with("success","User Updated");
        }catch(\Exception $ex){
            return redirect()->back()->with('error',$ex->getmessge());
        }
    }
   
}
