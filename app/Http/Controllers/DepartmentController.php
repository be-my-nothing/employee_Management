<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
      
    
       
    
    public function index()
    {   
        
        $data=Department::orderBy('id','desc')->get();
        return view('departmenet\index',['data'=>$data]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departmenet\create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $data=new Department();
        $data->title=$request->title;
        $data->save();

        return redirect('depart/create')->with('msg','Department has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Department::find($id);
        return view('departmenet\show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Department::find($id);
        return view('departmenet\edite',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $data=Department::find($id);
        $data->title=$request->title;
        $data->save();

        return redirect('depart/'.$id.'/edit')->with('msg',' Department has been updated');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Department::where('id',$id)->delete();
        return redirect('depart');
    }
}
