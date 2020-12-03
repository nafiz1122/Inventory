<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Auth;
class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        return view('admin.unit.view-unit',compact('units'));
    }

    public function store(REQUEST $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25|',
        ]);

        $unit = new Unit();
        $unit->name       = $request->name;
        $unit->created_by = Auth::user()->id;

        $unit->save();

        return redirect()->route('unit.list')->with('message','Data Save Successfully');
    }

    public function edit($id){
        $unit = Unit::find($id);
        return view('admin.unit.edit-unit',compact('unit'));
    }

    public function update(REQUEST $request,$id)
    {
        $unit = Unit::find($id);
        $unit->name       = $request->name;
        $unit->updated_by = Auth::user()->id;

        $unit->update();
        return redirect()->route('unit.list')->with('message','Data Update Successfully');
    }

    public function delete($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->route('unit.list')->with('message','Data Delete Successfully');
    }
}
