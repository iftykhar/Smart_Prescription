<?php

namespace App\Http\Controllers;

use App\Models\prescription;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection|prescription[]
     */
    public function index()
    {
        return prescription::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
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

            $attribute = array(
                'patient_name' => $request->input('patient_name'),
                'patient_age' => $request->input('patient_age'),
                'patient_gender' => $request->input('patient_gender'),
                'patient_weight' => $request->input('patient_weight'),
                'patient_bp_high' => $request->input('patient_bp_high'),
                'patient_bp_low' => $request->input('patient_bp_low'),
                'status' => $request->input('status')
            );

            prescription::create($attribute);
            return response()->json(['status' => true , 'message' => 'success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\prescription $prescription
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(prescription $prescription): JsonResponse
    {
        try {
            $pres = prescription::findOrFail($prescription->id);
            return response()->json($pres);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prescription  $prescription
     * @return void
     */
    public function edit(prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\prescription $prescription
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, prescription $prescription): JsonResponse
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
                $pres = prescription::findOrFail($prescription);
                $attribute = array(
                    'patient_name' => $request->input('patient_name'),
                    'patient_age' => $request->input('patient_age'),
                    'patient_gender' => $request->input('patient_gender'),
                    'patient_weight' => $request->input('patient_weight'),
                    'patient_bp_high' => $request->input('patient_bp_high'),
                    'patient_bp_low' => $request->input('patient_bp_low'),
                    'status' => $request->input('status')
                );
                $pres->update($attribute);
                return response()->json('done');
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\prescription $prescription
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(prescription $prescription): JsonResponse
    {
        PrescriptionController::destroy($prescription->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
