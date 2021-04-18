<?php

namespace App\Http\Controllers;

use App\Models\MedicineSuggestion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(MedicineSuggestion::all());
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


    public function store(Request $request): JsonResponse
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
            MedicineSuggestion::create([
                'symptom_name' => $request->input('symptom_name'),
                'medicine_name' => $request->input('medicine_name'),
                'medicine_days' => $request->input('medicine_days'),
                'medicine_morning' => $request->input('medicine_morning'),
                'medicine_afternoon' => $request->input('medicine_afternoon'),
                'medicine_evening' => $request->input('medicine_evening'),
                'medicine_night' => $request->input('medicine_night'),
                'medicine_continues' => $request->input('medicine_continues'),
                'medicine_score' => 0
            ]);
            return response()->json(['status' => true, 'message' => 'data insert success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MedicineSuggestion $medicineSuggestion
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(MedicineSuggestion $medicineSuggestion): JsonResponse
    {
        try{
             return response()->json(MedicineSuggestion::findOrFail($medicineSuggestion->id));
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicineSuggestion  $medicineSuggestion
     * @return void
     */
    public function edit(MedicineSuggestion $medicineSuggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MedicineSuggestion $medicineSuggestion
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, MedicineSuggestion $medicineSuggestion): JsonResponse
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

        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $med = MedicineSuggestion::findOrfail($medicineSuggestion->id);
                $med->update([
                    'symptom_name' => $request->input('symptom_name'),
                    'medicine_name' => $request->input('medicine_name'),
                    'medicine_days' => $request->input('medicine_days'),
                    'medicine_morning' => $request->input('medicine_morning'),
                    'medicine_afternoon' => $request->input('medicine_afternoon'),
                    'medicine_evening' => $request->input('medicine_evening'),
                    'medicine_night' => $request->input('medicine_night'),
                    'medicine_continues' => $request->input('medicine_continues'),
                    'medicine_score' => 0
                ]);
                return response()->json(['status' => true, 'message' => 'update Success']);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MedicineSuggestion $medicineSuggestion
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MedicineSuggestion $medicineSuggestion): JsonResponse
    {
        MedicineSuggestion::destroy($medicineSuggestion->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
