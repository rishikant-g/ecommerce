<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Banner;
class BannerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="/edit/'.$row->id.'/banner"><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;<i class="fas fa-trash-alt delete-banner" data-id="'.$row->id.'"></i>';
                    return $btn;
                }) ->addColumn('banner_preview', function($image){
                    $url =asset("storage/banner/$image->banner_image"); 
                    $img = '<img src="'.$url.'" border="0" width="80" class="img-rounded" align="center" />'; 
                    return $img;
                })
            ->rawColumns(['banner_preview','action'])
                ->toJson();
        }

        return view('Admin.Banner.manage-banner');
    }

    public function create()
    {
        return view('Admin.Banner.add-banner');
    }

    public function store(Request $request)
    {
            $request->validate( [
                'banner_name' => 'required|string|max:255',
                'banner_image' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
            ]);
            try{
                if ($request->hasFile('banner_image')) {
                    $image = $request->file('banner_image');
                    $name = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/storage/banner/');
                    $image->move($destinationPath, $name);
                    
                    Banner::create([
                        'banner_name' => $request->banner_name,
                        'banner_image' => $name,
                    ]);
                    return redirect()->back()->with('success','Banner saved');
                }
        }
        catch(\Exception $ex){
            return back()->with('error',$ex->getMessage() );
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        try{
            return view('Admin.Banner.edit-banner')->with('banner',$banner);
        }catch(\Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
        
    }

    public function update($id, Request $request)
    {
        $request->validate( [
            'banner_name' => 'required|string|max:255|unique:banners,banner_name,'.$id,
        ]);

        $banner = Banner::findOrFail($id);

        try{
            $name = '';
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/storage/banner/');
                $image->move($destinationPath, $name);
            }
            $banner->banner_name =  $request->banner_name;
            if(!empty($name)){
                $banner->banner_image = $name ;
            }
           
            $banner->save();
            return redirect()->back()->with('success','Banner saved');
    }
    catch(\Exception $ex){
        return back()->with('error',$ex->getMessage() );
    }
    }


    public function destroy(Request $request)
    {
        try{
            $banner = Banner::findOrFail($request->id);
            $banner->delete();
            return response()->json(['status' => true, 'message' => "Banner deleted "]);
        }
        catch(\Exception $ex){
            return response()->json(['status' => false, 'message' => $ex->getMessage()]);
        }
    }
}
