<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Cart;
use DB;
use App\Product;
class CartController extends Controller
{

    public function index()
    {
        // $products = Cart::sum('quantity')->groupBy('product_id');
        $products = Cart::groupBy('product_id')->selectRaw('product_id,sum(quantity) as sum')->get();
        $data = [];
        foreach($products as $p){
            $product = Product::find($p->product_id);
            $images = Product::find($p->product_id)->images->first();

            $data[$product->id]=$product;
            $data[$product->id]['quantity']=$p->sum;
            $data[$product->id]['images']=$images;
        }
        // foreach($data as $key => $value){
        //     return response()->json($value->product_title); 
        // }
        // return response()->json($data);
        return view('Shop.cart-details')->with('carts',$data);
    }

    public function addToCart(Request $request)
    {
        // $sessionId =  config('custom.sessionId');
        $sessionId =Session::getId();
        Session('sessionId',$sessionId);
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
        }

        Cart::create([
           'session_id' => $sessionId,
           'product_id' => $request->product_id,
           'quantity' => $request->quantity,
        ]);
        $count = Cart::where(['session_id' => $sessionId])->sum('quantity');
        // $count = Cart::sum('quantity');
        return response()->json(['status' => true, 'message'=> 'added to cart','count' => $count]);
    }
}
