<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view("pages.products.index", compact("products"));
    }

    public function create()
    {
        return view("pages.products.create");
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Product::create($data);
        return redirect()->route("product.index")->with("success", "Product successfully created");
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view("pages.products.edit", compact("product"));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);
        $product->update($data);
        return redirect()->route("product.index")->with("success", "Product successfully Updated");
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route("product.index")->with("success", "Product successfully Deleted");
    }
}
