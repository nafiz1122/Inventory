<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customer.view-customer',compact('customers'));
    }

    public function store(REQUEST $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25|',
            'phone_no' => 'required|unique:customers|max:25|min:11',
            'address' => 'required|max:45|',
           
        ]);

        $customer = new Customer();
        $customer->name       = $request->name;
        $customer->phone_no   = $request->phone_no;
        $customer->email      = $request->email;
        $customer->address    = $request->address;
        $customer->created_by = Auth::user()->id;

        $customer->save();

        return redirect()->route('customer.list')->with('message','Data Save Successfully');
    }

    public function edit($id){
        $customer = Customer::find($id);
        return view('admin.customer.edit-customer',compact('customer'));
    }

    public function update(REQUEST $request,$id)
    {
        $customer = Customer::find($id);
        $customer->name       = $request->name;
        $customer->phone_no   = $request->phone_no;
        $customer->email      = $request->email;
        $customer->address    = $request->address;
        $customer->updated_by = Auth::user()->id;

        $customer->update();
        return redirect()->route('customer.list')->with('message','Data Update Successfully');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customer.list')->with('message','Data Delete Successfully');
    }
}
