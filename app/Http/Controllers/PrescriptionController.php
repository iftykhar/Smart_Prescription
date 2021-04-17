<?php

namespace App\Http\Controllers;

use App\Models\prescription;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return PrescriptionContoller::all();
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
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //validation procedure
        $validate = Validator::make($request->all(),[
            'patient_name' => 'required',
            'patient_age' => 'required',
            'patient_gender' => 'required',
            'patient_weight' => 'required',
            'patient_bp_high' => 'required',
            'patient_bp_low' => 'required',
            'status' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            return response()->json(['status' => true , 'message' => 'success']);

        }

        $pres = new prescription;

        $pres->patient_name = $request->patient_name;
        $pres->patient_age = $request->patient_age;
        $pres->patient_gender = $request->patient_gender;
        $pres->patient_weight = $request->patient_weight;
        $pres->patient_bp_high = $request->patient_bp_high;
        $pres->patient_bp_low = $request->patient_bp_low;
        $pres->status = $request->status;

        $pres->save();
        return response()->json(['status'=>true, 'message'=>'data uploaded']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(prescription $prescription): \Illuminate\Http\JsonResponse
    {
        //
        try {
            $pres = PrescriptionController::findOrfail($prescription->id);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
        return $pres;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prescription $prescription): \Illuminate\Http\JsonResponse
    {
        //validation procedure
        $validate = Validator::make($request->all(),[
            'patient_name' => 'required',
            'patient_age' => 'required',
            'patient_gender' => 'required',
            'patient_weight' => 'required',
            'patient_bp_high' => 'required',
            'patient_bp_low' => 'required',
            'status' => 'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $pres = PrescriptionController::findOrfail($prescription->id);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }

        $pres->patient_name = $request->patient_name;
        $pres->patient_age = $request->patient_age;
        $pres->patient_gender = $request->patient_gender;
        $pres->patient_weight = $request->patient_weight;
        $pres->patient_bp_high = $request->patient_bp_high;
        $pres->patient_bp_low = $request->patient_bp_low;
        $pres->status = $request->status;

        $pres->save();
            return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(prescription $prescription): \Illuminate\Http\JsonResponse
    {
        PrescriptionController::destroy($prescription->);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
