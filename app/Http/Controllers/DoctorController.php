<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{

    public function index()
    {
       return Doctor::all();
    }


    public function create()
    {
        //
        return 0;
    }


    public function store(Request $request)
    {



        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'degree' => 'required',
            'phone' => 'required|min:11|max:11',
            'email' => 'required|unique:doctors|email',
            'address' => 'required',
        ]);

        if($validator->fails()){
            return response($validator->errors());
        }else{

       $doc = new Doctor;

           $doc->name = $request->name;
           $doc->degree = $request->degree;
           $doc->phone = $request->phone;
           $doc->email = $request->email;
           $doc->address = $request->address;
           $doc->hospital_id = 0;

           $doc->save();
            return response()->json(['status' => true, 'message' => 'data insert success']);
        }

    }


    public function show($id)
    {
        //
        return Doctor::find($id);
    }


    public function edit($id)
    {
       //
    }


    public function update(Request $request, Doctor $doctor): array
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


    public function destroy(Doctor $doctor)
    {
        Doctor::destroy($doctor->id);
        return response()->json(['status' => true, 'message' => 'delete success']);

    }
}
