<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Symptom::all();
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
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom): \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptom $symptom): \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom): \Illuminate\Http\JsonResponse
    {
        Symptom::destroy($symptom->id);
        return response()->json(['status'=>true, 'message'=>'delete successfull']);
    }
}
