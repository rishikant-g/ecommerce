<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Category;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }
    
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="edit/'.$row->id.'/category"><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;<i class="fas fa-trash-alt delete-category" data-id="'.$row->id.'"></i>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('Admin.Category.manage-category');
    }

    public function create()
    {
        $response = Gate::inspect('add-category', \Auth::user());

        if ($response->allowed()) {
            return view('Admin.Category.add-category');
        } else {
            echo $response->message();
        }
            
        
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => ['required','string','max:255','unique:categories'],
        ]);
        
        try{
            Category::create(['category_name' => $request->category_name]);
            return redirect()->back()->with('success','Category added');
        }
        catch(\Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage()); 
        }
        


    }

    public function edit($id)
    {
            $category = Category::findOrFail($id);
            return view('Admin.Category.edit-category')->with('category',$category);
        
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'category_name' => ['required','string','max:255','unique:categories'],
        ]);

        $category = Category::findOrFail($id);
        try{
            $category->category_name = $request->category_name;
            $category->save();
            return redirect()->back()->with('success','Category Updated');
        }catch(\Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }



    public function destroy(Request $request,$id)
    {
            try{
                $category = Category::findOrFail($id);
                $category->delete();
                return response()->json(['status' => true, 'message' => "Category deleted"]);
            }
            catch(\Exception $ex){
                return response()->json(['status' => false, 'message' => 'Invalid category id']);
            }  
        } 
}
