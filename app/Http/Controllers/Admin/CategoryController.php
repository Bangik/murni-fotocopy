<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:150',
            'picturePath' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if($request->hasFile('picturePath')){
            $imagee = $request->picturePath;
            $image_name = time().'-'.$imagee->getClientOriginalName();
            $imagee->move('assets/img/category/', $image_name);
            $image_path = 'assets/img/category/'. $image_name;
            $category->path_image = $image_path;
        }
        // dd($request->all());
        $category->save();

        toastr()->success('Data Berhasil ditambahkan');
        return redirect()->route('categories.index');
    }

    public function update($category, Request $request){
        $this->validate($request,[
            'name' => 'required|max:150',
            'picturePath' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = Category::find($category);
        $category->name = $request->name;

        if($request->hasFile('picturePath')){
            $pictureFrom = str_replace(config('app.url')."/", "", $category->picturePath);
            if (file_exists($pictureFrom)) {
                unlink($pictureFrom);
            }
            $imagee = $request->picturePath;
            $image_name = time().'-'.$imagee->getClientOriginalName();
            $imagee->move('assets/img/category/', $image_name);
            $image_path = 'assets/img/category/'. $image_name;
            $category->path_image = $image_path;
        }
        $category->save();

        toastr()->success('Data Berhasil diubah');
        return redirect()->route('categories.index');
    }

    public function destroy($category){
        $category = Category::find($category);
        if (file_exists($category->path_image)) {
            unlink($category->path_image);
        }
        $category->delete();

        toastr()->success('Data Berhasil dihapus');
        return redirect()->route('categories.index');
    }
}
