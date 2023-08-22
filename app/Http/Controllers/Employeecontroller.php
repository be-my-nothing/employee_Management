<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Department;


class Employeecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Employees::orderBy('id','desc')->get();
        return view('employee\index',['data'=>$data]);

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=Department::orderBy('id','desc')->get();
        return view('employee.create',['departments'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'=>'required',
            'photo'=>'required|image|mimes:jpg,png,gif,jpeg',
            'address'=>'required',
            'mobile'=>'required',
            'status'=>'required',
        ]);

        $photo=$request->file('photo');
        $renamePhoto=time().'.'.$photo->getClientOriginalExtension();
        $dest=public_path('/images');
        $photo->move($dest,$renamePhoto);

        $data=new Employees();
        $data->department_id=$request->depart;
        $data->full_name=$request->full_name;
        $data->photo=$renamePhoto;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status;
        $data->save();

        return redirect('emp/create')->with('msg','employee has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Employees::find($id);
        return view('employee.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departs=Department::orderBy('id','desc')->get();
        $data=Employees::find($id);
        return view('employee.edite',['departs'=>$departs,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'status'=>'required',
        ]);


        if($request->hasFile('photo')){
            $photo=$request->file('photo');
            $renamePhoto=time().'.'.$photo->getClientOriginalExtension();
            $dest=public_path('/images');
            $photo->move($dest,$renamePhoto);
        }else{
            $renamePhoto=$request->prev_photo;
        }

        $data=Employees::find($id);
        $data->department_id=$request->depart;
        $data->full_name=$request->full_name;
        $data->photo=$renamePhoto;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status;
        $data->save();

        return redirect('emp/'.$id.'/edit')->with('msg','employee has been submitted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employees::where('id',$id)->delete();
        return redirect('emp');
    }
}
