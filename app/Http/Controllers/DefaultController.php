<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class DefaultController extends Controller
{
    public function get_category(REQUEST $request)
    {
        $supplier_id = $request->supplier_id;
        $allcategory =Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        //dd($allcategory);
        return response()->json($allcategory);
    }
    public function get_product(REQUEST $request)
    {
        $category_id = $request->category_id;
        $allProduct  = Product::where('category_id',$category_id)->get();
        return response()->json($allProduct);
    }
}
