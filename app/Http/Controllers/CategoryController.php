<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('admin.category.view-category',compact('categorys'));
    }

    public function store(REQUEST $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25|',
        ]);

        $category = new Category();
        $category->name       = $request->name;
        $category->created_by = Auth::user()->id;

        $category->save();

        return redirect()->route('category.list')->with('message','Data Save Successfully');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit-category',compact('category'));
    }

    public function update(REQUEST $request,$id)
    {
        $category = Category::find($id);
        $category->name       = $request->name;
        $category->updated_by = Auth::user()->id;

        $category->update();
        return redirect()->route('category.list')->with('message','Data Update Successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.list')->with('message','Data Delete Successfully');
    }
}
