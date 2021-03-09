<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $doc = Doctor::all();
       return view('doctor.index',compact('doc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request-> all();
        $doc = new Doctor;

        $doc->name = $request->name;
        $doc->degree = $request->degree;
        $doc->phone = $request->phone;
        $doc->email = $request->email;
        $doc->address = $request->address;
        $doc->hospital_id = 0;
        $doc->save();

        return  view('doctor.create', ['message'=>'sucessfull creation']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $doc = Doctor::findOrfail($doctor->id);
        return view('doctor.edit', compact('doc',$doc));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //validation for update
        $request->validate([
            'name' => 'required',
            'degree' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        //update
        $doc = Doctor::findOrfail($doctor->id);
        $doc->name = $request->name;
        $doc->degree = $request->degree;
        $doc->phone = $request->phone;
        $doc->email = $request->email;
        $doc->address = $request->address;

        $doc->save();

        return redirect('doctor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //delete
        $doc = Doctor::findOrfail($doctor->id);

        $doc->delete();
        return redirect('doctor');
    }
}
