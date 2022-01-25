<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaction;
use App\Models\Product;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = Transaction::all()->sortByDesc('id');
        return view('admin.transaction.index', compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = Transaction::findOrFail($id);
        $details = DetailTransaction::where('transaction_id', $id)->get();
        // dd($details);
        return view('admin.transaction.detail', compact('details', 'transaction'));
    }

    public function create()
    {
        $products = Product::get(['id', 'name', 'price', 'stock', 'category_id'])->groupBy('category.name');
        // dd($products);
        return view('admin.transaction.create', compact('products'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'total' => 'required',
        ]);

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'total' => $request->total,
            'pay' => $request->pay,
            'changes' => $request->change,
            'status' => $request->status,
        ]);

        foreach ($request->product as $key => $value) {
            DetailTransaction::create([
                'transaction_id' => $transaction->id,
                'product_id' => $value,
                'quantity' => $request->quantity[$key],
                'subtotal' => $request->subtotal[$key],
            ]);
            Product::find($value)->update([
                'stock' => Product::find($value)->stock - $request->quantity[$key],
            ]);
        }

        return $transaction;
    }

    public function nota($id){
        $transaction = Transaction::find($id);
        $details = DetailTransaction::where('transaction_id', $transaction->id)->get();
        return view('admin.transaction.nota', compact('transaction', 'details'));
    }

    public function update(Request $request, $id){
        $transaction = Transaction::find($id);
        $transaction->status = $request->status;
        $transaction->pay = $request->pay;
        $transaction->changes = $request->changes;
        $transaction->save();
        return $transaction;
    }

    public function delete($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect()->route('transactions.index');
    }
}
