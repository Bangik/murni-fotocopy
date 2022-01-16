<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create(){
        return view('admin.brand.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'brand' => 'required|max:150',
            'picturePath' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->brand = $request->brand;

        if($request->hasFile('picturePath')){
            $imagee = $request->picturePath;
            $image_name = time().'-'.$imagee->getClientOriginalName();
            $imagee->move('assets/img/brand/', $image_name);
            $image_path = 'assets/img/brand/'. $image_name;
            $brand->path_image = $image_path;
        }

        $brand->save();
        toastr()->success('Data Berhasil ditambahkan');
        return redirect()->route('brands.index');
    }

    public function storeAjax(Request $request){
        $this->validate($request,[
            'name' => 'required|max:150',
        ]);

        $brand = new Brand();
        $brand->brand = $request->name;
        $brand->save();
        return $brand;
    }

    public function update($brand, Request $request){
        $this->validate($request,[
            'brand' => 'required|max:150',
            'picturePath' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = Brand::find($brand);
        $brand->brand = $request->brand;

        if($request->hasFile('picturePath')){
            if (file_exists($brand->path_image)) {
                unlink($brand->path_image);
            }
            $imagee = $request->picturePath;
            $image_name = time().'-'.$imagee->getClientOriginalName();
            $imagee->move('assets/img/brand/', $image_name);
            $image_path = 'assets/img/brand/'. $image_name;
            $brand->path_image = $image_path;
        }

        $brand->save();
        toastr()->success('Data Berhasil ditambahkan');
        return redirect()->route('brands.index');
    }

    public function destroy($brand){
        $brand = Brand::find($brand);
        if (file_exists($brand->path_image)) {
            unlink($brand->path_image);
        }
        $brand->delete();
        toastr()->success('Data Berhasil dihapus');
        return redirect()->route('brands.index');
    }
}
