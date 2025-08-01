<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastProduct = Product::orderBy('id', 'desc')->first();
        $lastCode = $lastProduct ? intval($lastProduct->product_code) : 0;
        $newCode = str_pad($lastCode + 1, 4, '0', STR_PAD_LEFT);
        return view('products.create', compact('newCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|unique:products,product_code',
            'name' => 'required|string|max:255',
            'uom' => 'required|string|max:50',
            'quantity' => 'required|integer|min:0',
            'document' => 'required|string|max:50',
            'entry_date' => 'required|date',
        ]);
        $product = Product::create($request->only(['name', 'uom', 'product_code', 'quantity']));
        $date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->entry_date)->format('Y-m-d');
        if ($product->quantity > 0) {
            Transaction::create([
                'product_id' => $product->id,
                'document' => $request->document,
                'in' => $product->quantity,
                'out' => 0,
                'date' => $date,
                'remaining' => $product->quantity,
            ]);
        }
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
