<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->json(Symptom::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(),[
            'symptoms_name'=> 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            Symptom::create([
                'symptoms_name' => $request->input('symptoms_name')
            ]);
            return response()->json(['status'=>true, 'message'=>'data stored successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return JsonResponse
     */
    public function show(Symptom $symptom): JsonResponse
    {
        try {
             return response()->json(Symptom::findOrFail($symptom->id));
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return void
     */
    public function edit(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Symptom $symptom
     * @return JsonResponse
     */
    public function update(Request $request, Symptom $symptom): JsonResponse
    {
        $validate = Validator::make($request->all(),[
            'symptoms_name'=> 'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $symptomData = Symptom::findOrfail($symptom);

                $symptomData->update([
                    'symptoms_name' => $request->input('symptom_name')
                ]);
                return response()->json('Update Success');
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return Response
     */
    public function destroy(Symptom $symptom): JsonResponse
    {
        Symptom::destroy($symptom->id);
        return response()->json(['status'=>true, 'message'=>'delete successful']);
    }
}
