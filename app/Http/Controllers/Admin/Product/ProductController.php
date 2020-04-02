<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Image;
use Yajra\DataTables\DataTables;
class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('customer');
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
        
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/edit/'.$row->id.'/product"><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;<i class="fas fa-trash-alt delete-product" data-id="'.$row->id.'"></i>';
                    return $btn;
                })
                ->addColumn('product_category',function($product){
                    $product_category = '';
                    foreach($product->categories as $category){
                        $product_category .=$category->category_name;
                    }
                    return $product_category;
                })
                ->addColumn('image',function($product){
                    $images = Image::where(['product_id' => $product->id])->first();
                    $img ='';
                    if(!empty($images)){
                        $url =asset("storage/products/$images->product_image"); 
                        $img = '<img src="'.$url.'" border="0" width="80" class="img-rounded" align="center" />'; 
                    }else{
                        $img = '<span>No Image</span>';
                    }                   
                    return $img;
                    // foreach($images as $image){
                    // $url =asset("storage/products/$image->product_image"); 
                    // $img .= '<img src="'.$url.'" border="0" width="80" class="img-rounded" align="center" />'; 
                    
                    // }
                    // return $img;
                })
                ->rawColumns(['product_category','image','action'])
                ->toJson();
        }

        return view('Admin.Product.manage-product');
    }

    public function create()
    {
        return view('Admin.Product.add-product')->with('categories',Category::all());
    }

    public function store(\App\Http\Requests\StoreProductRequest $request)
    {
        $request->validated();
        
            try{
                $product = Product::create([
                    'product_title' => $request->product_title,
                    'product_description' => $request->product_description,
                    'product_price' => $request->product_price,
                    'product_quantity' => $request->product_quantity,
                 ]);

                $product->categories()->attach($request->categories);

                $arr=[];
                $images = $request->file('product_images');
                if ($request->hasFile('product_images')) {
                    foreach ($images as $item){
                        $var = date_create();
                        $time = date_format($var, 'YmdHis');
                        $imageName = $time . '-' . $item->getClientOriginalName();
                        $item->move(public_path('/storage/products/'), $imageName);
                        $arr[] = $imageName;
                    }
                $image = implode(",", $arr);
                }
                else{
                    $image = '';
                }
               
                
                foreach($arr as $img){
                Image::create([
                    'product_id' => $product->id,
                    'product_image' => $img,
                ]);
                }
                return redirect()->back()->with('success','Product added');
                }catch(\Exception $ex){
                    dd($ex);
                }
          
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        try{
            $category = $product->categories; // categories which are exist in product
            $images = Image::where(['product_id' => $product->id])->get();
            $categories = Category::all(); // all category
            return view('Admin.Product.edit-product')->with('product',$product)->with('product_category',$category)
            ->with('images',$images)->with('categories',$categories);
        }catch(\Exception $ex){
            return redirect()->back()->with('errors',$ex->getMessage());
        }
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'product_title' => ['required','string','max:255','unique:products,product_title,'.$id],
            'product_description' => ['required','string'],
            'product_price' => ['required','numeric'],
            'product_quantity' => ['required','integer'],
            'categories' => ['required'],
            'categories.*' => ['integer'],
        ]);
            $product = Product::findOrFail($id);
        try{
            
                $product->product_title = $request->product_title;
                $product->product_description = $request->product_description;
                $product->product_price = $request->product_price;
                $product->product_quantity = $request->product_quantity;
                $product->save();

            $product->categories()->sync($request->categories);

            $arr=[];
            $images = $request->file('product_images');
            if ($request->hasFile('product_images')) {
                foreach ($images as $item){
                    $var = date_create();
                    $time = date_format($var, 'YmdHis');
                    $imageName = $time . '-' . $item->getClientOriginalName();
                    $item->move(public_path('/storage/products/'), $imageName);
                    $arr[] = $imageName;
                }
            $image = implode(",", $arr);
            }
            else{
                $image = '';
            }
           
            
            foreach($arr as $img){
            Image::create([
                'product_id' => $product->id,
                'product_image' => $img,
            ]);
            }
            return redirect()->back()->with('success','Product added');
            }catch(\Exception $ex){
                dd($ex);
            }


    }

    public function destroy($id)
    {
        try{
             $product = Product::findOrFail($id);
             $product->delete();
             $product->categories()->detach($product->id);
             
             $image = Image::where(['product_id' => $product->id])->first();
             if(!empty($image)) 
             Image::where(['product_id' => $product->id])->delete();
             return response()->json(['status' => true, 'message'=> 'Product Deleted']);
        }catch(\Exception $ex){
            return response()->json(['status' => false, 'message'=> $ex->getMessage()]);
        }
    }
}
