<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\unit;
use App\Models\Category;

use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products    = Product::all();
        $suppliers   = Supplier::all();
        $units       = Unit::all();
        $categories  = Category::all();
        return view('admin.product.view-product',compact('products','suppliers','units','categories'));
    }

    public function store(REQUEST $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25|',
            'supplier_id' => 'required',
            'category_id' => 'required|max:45|',
            'unit_id' => 'required|max:45|',
           
        ]);

        $product = new Product();
        $product->supplier_id   = $request->supplier_id;
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->unit_id       = $request->unit_id;
        $product->quantity      = '0';
        $product->created_by = Auth::user()->id;
        $product->save();
        return redirect()->route('product.list')->with('message','Data Save Successfully');
    }

    public function edit($id){
        $editProduct = Product::find($id);
        $suppliers   = Supplier::all();
        $units       = Unit::all();
        $categories  = Category::all();
        return view('admin.product.edit-product',compact('editProduct','suppliers','units','categories'));
    }

    public function update(REQUEST $request,$id)
    {
        $product = Product::find($id);
        $product->supplier_id   = $request->supplier_id;
        $product->category_id   = $request->category_id;
        $product->name          = $request->name;
        $product->unit_id       = $request->unit_id;
        $product->quantity      = '0';
        $product->created_by = Auth::user()->id;

        $product->update();
        return redirect()->route('product.list')->with('message','Data Update Successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.list')->with('message','Data Delete Successfully');
    }
}
