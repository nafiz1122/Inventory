<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
class PurchaseController extends Controller
{
    public function index()
    {
        $purchases    = Purchase::orderBy('date','desc')->orderBy('id','desc');
        $suppliers    = Supplier::all();
        $units        = Unit::all();
        $categories   = Category::all();
        return view('admin.purchase.view-purchase',compact('purchases','suppliers','units','categories'));
    }
    public function add()
    { 
        $suppliers    = Supplier::all();
        $units        = Unit::all();
        $categories   = Category::all();
        return view('admin.purchase.add-purchase',compact('suppliers','units','categories'));
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
}
