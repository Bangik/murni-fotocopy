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
            $image_path = '/assets/img/category/'. $image_name;
            $category->path_image = $image_path;
        }
        // dd($request->all());
        $category->save();

        toastr()->success('Data Berhasil ditambahkan');
        return redirect()->route('categories.index');

    }
}
