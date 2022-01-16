<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $units = Unit::all();
        return view('admin.unit.index', compact('units'));
    }

    public function create(){
        return view('admin.unit.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|max:150',
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();

        toastr()->success('Data Berhasil ditambahkan');
        return redirect()->route('units.index');
    }

    public function storeAjax(Request $request){
        $this->validate($request,[
            'name' => 'required|max:150',
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();
        return $unit;
    }

    public function update($unit, Request $request){
        $this->validate($request,[
            'name' => 'required|max:150',
        ]);

        $unit = Unit::find($unit);
        $unit->name = $request->name;
        $unit->save();

        toastr()->success('Data Berhasil diubah');
        return redirect()->route('units.index');
    }

    public function destroy($unit){
        $unit = Unit::find($unit);
        $unit->delete();

        toastr()->success('Data Berhasil dihapus');
        return redirect()->route('units.index');
    }
}
