<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //store function
    public function store(Request $request)
    {
        //validate the request
        $validate = $request -> validate([
            'product_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'description' => 'required',
            'manufacturer' => 'required',
        ]);
        //create new product using validated data
        $product = Product::create($validate);
        //return with success message
        return redirect()->route('dashboard')-> with(['success' => 'Product added successfully!', 'newProduct' => $product,]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashboard')->with('destroy', 'Product deleted successfully!');
    }
    
    public function edit(Product $product)
    {
        return view('edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        //validate the request
        $validate = $request -> validate([
            'product_name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'description' => 'required',
            'manufacturer' => 'required',
        ]);
        //update product using validated data
        $product->update($validate);
        //return with success message
        return redirect()->route('dashboard')-> with('update', 'Product updated successfully!');
    }
}


