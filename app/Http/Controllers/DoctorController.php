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
       return Doctor::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'degree' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $doc = new Doctor;

        $doc->name = $request->name;
        $doc->degree = $request->degree;
        $doc->phone = $request->phone;
        $doc->email = $request->email;
        $doc->address = $request->address;
        $doc->hospital_id = 0;


        return  $doc->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Doctor::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
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

        return array('status' => true, 'message' => 'update success');
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
        return array('status' => true, 'message' => 'delete success');
    }
}
