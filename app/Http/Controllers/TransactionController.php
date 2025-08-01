<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'document' => 'required|string',
            'in' => 'nullable|integer|min:0',
            'out' => 'nullable|integer|min:0',
            'entry_date' => 'required|date',
        ]);

        $in = (int) $request->input('in', 0);
        $out = (int) $request->input('out', 0);
        $newQuantity = $product->quantity + $in - $out;

        if ($newQuantity < 0) {
            return back()->withErrors(['out' => 'Kuantitas barang kurang dari 0!.']);
        }

        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->entry_date)->format('Y-m-d');
        Transaction::create([
            'product_id' => $product->id,
            'document' => $request->document,
            'in' => $in,
            'out' => $out,
            'date' => $date,
            'remaining' => $newQuantity,
        ]);

        $product->quantity = $newQuantity;
        $product->save();

        return back()->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
