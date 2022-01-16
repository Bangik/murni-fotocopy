<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $units = Unit::all();
        return view('admin.product.create', compact('categories', 'brands', 'units'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'picturePath' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|max:150',
            'price' => 'required|numeric',
            'capitalPrice' => 'nullable|numeric',
            'barcode' => 'nullable|max:255',
            'stock' => 'nullable|numeric',
            'minStock' => 'nullable|numeric',
        ]);

        $product = new Product();
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->unit_id = $request->unit;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->capital_price = $request->capitalPrice;
        $product->barcode = $request->barcode;
        $product->stock = $request->stock;
        $product->min_stock = $request->minStock;

        if($request->hasFile('picturePath')){
            $imagee = $request->picturePath;
            $image_name = time().'-'.$imagee->getClientOriginalName();
            $imagee->move('assets/img/product/', $image_name);
            $image_path = 'assets/img/product/'. $image_name;
            $product->path_image = $image_path;
        }
        $product->save();
        toastr()->success('Data Berhasil ditambahkan');
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $units = Unit::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'units'));
    }

    public function update($id, Request $request){
        $this->validate($request,[
            'picturePath' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|max:150',
            'price' => 'required|numeric',
            'capitalPrice' => 'nullable|numeric',
            'barcode' => 'nullable|max:255',
            'stock' => 'nullable|numeric',
            'minStock' => 'nullable|numeric',
        ]);

        $product = Product::find($id);
        $product->category_id = $request->category;
        $product->brand_id = $request->brand;
        $product->unit_id = $request->unit;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->capital_price = $request->capitalPrice;
        $product->barcode = $request->barcode;
        $product->stock = $request->stock;
        $product->min_stock = $request->minStock;

        if($request->hasFile('picturePath')){
            if (file_exists($product->path_image)) {
                unlink($product->path_image);
            }
            $imagee = $request->picturePath;
            $image_name = time().'-'.$imagee->getClientOriginalName();
            $imagee->move('assets/img/product/', $image_name);
            $image_path = 'assets/img/product/'. $image_name;
            $product->path_image = $image_path;
        }
        $product->save();
        toastr()->success('Data Berhasil diubah');
        return redirect()->route('products.index');
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trashed', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
        toastr()->success('Data Berhasil di kembalikan');
        return redirect()->route('products.trashed');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        toastr()->success('Data Berhasil dihapus');
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::onlyTrashed()->find($id);
        // dd($product);
        if (file_exists($product->path_image)) {
            unlink($product->path_image);
        }
        $product->forceDelete();
        toastr()->success('Data Berhasil dihapus permanen');
        return redirect()->route('products.trashed');
    }
}
