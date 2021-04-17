<?php

namespace App\Http\Controllers;

use App\Models\MedicineSuggestion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineSuggestionController extends Controller
{

    public function index()
    {
        return MedicineSuggestion::all();
    }


    public function create()
    {

    }


    public function store(Request $request): JsonResponse
    {
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
            $values = array(
                'symptom_name' => $request->input('symptom_name'),
                'medicine_name' => $request->input('medicine_name'),
                'medicine_days' => $request->input('medicine_days'),
                'medicine_morning' => $request->input('medicine_morning'),
                'medicine_afternoon' => $request->input('medicine_afternoon'),
                'medicine_evening' => $request->input('medicine_evening'),
                'medicine_night' => $request->input('medicine_night'),
                'medicine_continues' => $request->input('medicine_continues'),
                'ms_score' => 0
            );
            MedicineSuggestion::create($values);
            return response()->json(['status' => true , 'message' => 'success']);
        }
    }


    public function show(MedicineSuggestion $medicineSuggestion): JsonResponse
    {
        try{
            $med = MedicineSuggestion::findOrfail($medicineSuggestion->id);
            return response()->json($med);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }


    public function edit(MedicineSuggestion $medicineSuggestion)
    {
        //
    }


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

        //update
        if($validate->fails()){
            return response()->json($validate->errors());
        }else {
            try {
                $med = MedicineSuggestion::findOrfail($medicineSuggestion);
                $attribute = array(
                    'symptom_name' => $request->input('symptom_name'),
                    'medicine_name' => $request->input('medicine_name'),
                    'medicine_days' => $request->input('medicine_days'),
                    'medicine_morning' => $request->input('medicine_morning'),
                    'medicine_afternoon' => $request->input('medicine_afternoon'),
                    'medicine_evening' => $request->input('medicine_evening'),
                    'medicine_night' => $request->input('medicine_night'),
                    'medicine_continues' => $request->input('medicine_continues'),
                    'ms_score' => 0
                );

                $med->update($attribute);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }
    }


    public function destroy(MedicineSuggestion $medicineSuggestion): JsonResponse
    {
        MedicineSuggestion::destroy($medicineSuggestion->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
