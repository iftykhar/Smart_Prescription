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
     * @return JsonResponse
     */
    public function index(): JsonResponse
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
        //validation
        $validate = Validator::make($request->all(),[
            'symptoms_name'=> 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            return response()->json(['status' => true , 'message' => 'success']);

        }

        $symp = new Symptom;

        $symp->symptoms_name = $request->symptoms_name;

        $symp->save();
        return response()->json(['status'=>true, 'message'=>'data stored successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return Response
     */
    public function show(Symptom $symptom): JsonResponse
    {
        try {
            $symp = Symptom::findOrfail($symptom);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
        return $symp;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return Response
     */
    public function edit(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Symptom  $symptom
     * @return Response
     */
    public function update(Request $request, Symptom $symptom): JsonResponse
    {
        //validation
        $validate = Validator::make($request->all(),[
            'symptoms_name'=> 'required',
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $symp = Symptom::findOrfail($symptom->id);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }



        $symp->symptoms_name = $request->symptoms_name;

        $symp->save();
        return response()->json('done');
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
        return response()->json(['status'=>true, 'message'=>'delete successfull']);
    }
}
