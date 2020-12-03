<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Robot;
class RobotController extends Controller
{
    public function index()
    {
        $robot = Robot::all();
        //dd($robot);
        return view('admin.robot.robotList',compact('robot'));
    }

    public function store(REQUEST $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
        ]);
        //dd($request->name);  

        $robot = new Robot();

        $robot['name'] = $request->name;
        $robot['email'] = $request->email;
        $robot['phone'] = $request->phone;

        $robot->save();

        return redirect()->route('robot.list')->with('message',"Data Insert Successfully");
    }
}
