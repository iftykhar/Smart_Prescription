<?php

namespace App\Http\Controllers;

use App\Models\MedicineSuggestion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return MedicineSuggestion::all();
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


    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        //
       $validate = Validator::make($request->all(), [
            'symptom_name' => 'required',
            'medicine_name' => 'required' ,
            'medicine_days' => 'required',
            'medicine_morning' => 'required',
            'medicine_afternoon' => 'required',
            'medicine_evening' => 'required',
            'medicine_night' => 'required',
            'medicine_continues' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            return response()->json(['status' => true , 'message' => 'success']);

        }
        $med = new MedicineSuggestion;

            $med->symptom_name = $request->symptom_name;
            $med->medicine_name = $request->medicine_name;
            $med->medicine_days = $request->medicine_days;
            $med->medicine_morning = $request->medicine_morning;
            $med->medicine_afternoon = $request->medicine_afternoon;
            $med->medicine_evening = $request->medicine_evening;
            $med->medicine_night = $request->medicine_night;
            $med->medicine_continues = $request->medicine_continues;
            $med->ms_score = 0;

            $med->save();
            return response()->json(['status' => true, 'message' => 'data insert success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicineSuggestion  $medicineSuggestion
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineSuggestion $medicineSuggestion): \Illuminate\Http\JsonResponse
    {
        //
        try{
            $med = MedicineSuggestion::findOrfail($medicineSuggestion->id);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
        return $med;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicineSuggestion  $medicineSuggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicineSuggestion $medicineSuggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicineSuggestion  $medicineSuggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicineSuggestion $medicineSuggestion): \Illuminate\Http\JsonResponse
    {
        //
        $validate = Validator::make($request->all(), [
            'symptom_name' => 'required',
            'medicine_name' => 'required' ,
            'medicine_days' => 'required',
            'medicine_morning' => 'required',
            'medicine_afternoon' => 'required',
            'medicine_evening' => 'required',
            'medicine_night' => 'required',
            'medicine_continues' => 'required',
        ]);

        //update
        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $med = MedicineSuggestion::findOrfail($medicineSuggestion);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }

        $med->symptom_name = $request->symptom_name;
        $med->medicine_name = $request->medicine_name;
        $med->medicine_days = $request->medicine_days;
        $med->medicine_morning = $request->medicine_morning;
        $med->medicine_afternoon = $request->medicine_afternoon;
        $med->medicine_evening = $request->medicine_evening;
        $med->medicine_night = $request->medicine_night;
        $med->medicine_continues = $request->medicine_continues;
        $med->ms_score = 0;

        $med->save();
        return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicineSuggestion  $medicineSuggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineSuggestion $medicineSuggestion): \Illuminate\Http\JsonResponse
    {
        //
        MedicineSuggestion::destroy($medicineSuggestion->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
