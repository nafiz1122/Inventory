<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Auth;
class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.view-supplier',compact('suppliers'));
    }

    public function store(REQUEST $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:25|',
            'phone_no' => 'required|unique:suppliers|max:25|min:11',
            'address' => 'required|max:45|',
           
        ]);

        $supplier = new Supplier();
        $supplier->name       = $request->name;
        $supplier->phone_no   = $request->phone_no;
        $supplier->email      = $request->email;
        $supplier->address    = $request->address;
        $supplier->created_by = Auth::user()->id;

        $supplier->save();

        return redirect()->route('supplier.list')->with('message','Data Save Successfully');
    }



    public function edit($id){
        $supplier = Supplier::find($id);
        return view('admin.supplier.edit-supplier',compact('supplier'));
    }

    public function update(REQUEST $request,$id)
    {
        $supplier = Supplier::find($id);
        $supplier->name       = $request->name;
        $supplier->phone_no   = $request->phone_no;
        $supplier->email      = $request->email;
        $supplier->address    = $request->address;
        $supplier->updated_by = Auth::user()->id;

        $supplier->update();
        return redirect()->route('supplier.list')->with('message','Data Update Successfully');
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('supplier.list')->with('message','Data Delete Successfully');
    }
}
