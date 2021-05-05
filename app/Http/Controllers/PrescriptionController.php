<?php

namespace App\Http\Controllers;

use App\Models\prescription;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @method static findOrFail(mixed $id)
 */
class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(prescription::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
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

            $attributes = array(
                'patient_name' => $request->input('patient_name'),
                'patient_age' => $request->input('patient_age'),
                'patient_gender' => $request->input('patient_gender'),
                'patient_weight' => $request->input('patient_weight'),
                'patient_bp_high' => $request->input('patient_bp_high'),
                'patient_bp_low' => $request->input('patient_bp_low'),
                'status' => $request->input('status')
            );

            Prescription::create($attributes);
            return response()->json(['status'=>true, 'message'=>'data uploaded']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param prescription $prescription
     * @return JsonResponse
     */
    public function show(prescription $prescription): JsonResponse
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function update(Request $request, Prescription $prescription): JsonResponse
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

        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $pres = PrescriptionController::findOrFail($prescription->id);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }

        $attributes = array(
            'patient_name' => $request->input('patient_name'),
            'patient_age' => $request->input('patient_age'),
            'patient_gender' => $request->input('patient_gender'),
            'patient_weight' => $request->input('patient_weight'),
            'patient_bp_high' => $request->input('patient_bp_high'),
            'patient_bp_low' => $request->input('patient_bp_low'),
            'status' => $request->input('status')
        );

        $pres->update($attributes);
        return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prescription $prescription
     * @return JsonResponse
     */
    public function destroy(Prescription $prescription): JsonResponse
    {
        PrescriptionController::destroy($prescription->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
