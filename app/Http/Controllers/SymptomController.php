<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Symptom::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //validation
        $validate = Validator::make($request->all(),[
            'symptoms_name'=> 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{

            Symptom::create([
                'symptoms_name' => $request->input('symptoms_name')
            ]);
            return response()->json(['status' => true , 'message' => 'success']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param Symptom $symptom
     * @return JsonResponse
     */
    public function show(Symptom $symptom): JsonResponse
    {
        try {
            $symptomModel = Symptom::findOrfail($symptom);
            return response()->json($symptomModel);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Symptom $symptom
     * @return JsonResponse
     */
    public function update(Request $request, Symptom $symptom): JsonResponse
    {
        //validation
        $validate = Validator::make($request->all(),[
            'symptoms_name'=> 'required'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $symptomModel = Symptom::findOrfail($symptom->id);
                $symptomModel->update([
                    '' => $request->input()
                ]);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }
        return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Symptom $symptom
     * @return JsonResponse
     */
    public function destroy(Symptom $symptom): JsonResponse
    {
        Symptom::destroy($symptom->id);
        return response()->json(['status'=>true, 'message'=>'delete successfull']);
    }
}
