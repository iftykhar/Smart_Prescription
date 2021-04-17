<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{

    public function index()
    {
       return Doctor::all();
    }


    public function create(): int
    {
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
           $attribute = array(
               'name' => $request->input('name'),
               'degree' => $request->input('degree'),
               'phone' => $request->input('phone'),
               'email' => $request->input('email'),
               'address' => $request->input('address'),
               'hospital_id' => 0,
           );
             Doctor::create($attribute);
            return response()->json(['status' => true, 'message' => 'Doctor Profile Create Success']);
        }
    }


    public function show($id): JsonResponse
    {
        // handle failed error by using try catch block, this catch block catch ModelNotFoundException from Model
        try {
            $doctor =  Doctor::findOrfail($id);

        }catch (ModelNotFoundException $exception){
         return response()->json(['Not found'], 404);
        }
        return response()->json($doctor);
    }


    public function edit($id)
    {
       //
    }


    public function update(Request $request, $id): JsonResponse
    {
        //validation for update
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'degree' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            try {
             $doctor = Doctor::findOrfail($id);
                $attribute = array(
                    'name' => $request->input('name'),
                    'degree' => $request->input('degree'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'address' => $request->input('address'),
                    'hospital_id' => 0,
                );
                $doctor->update($attribute);

                return response()->json('Update success');
            }catch (ModelNotFoundException $exception){
                return response()->json('not found model');
            }
        }
    }


    public function destroy(Doctor $doctor): JsonResponse
    {
        Doctor::destroy($doctor->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
