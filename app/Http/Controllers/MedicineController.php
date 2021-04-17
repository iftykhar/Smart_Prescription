<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{

    public function index()
    {
        return Medicine::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(),[
            'medicine_name' => 'required',
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
            $attribute = array(
                'symptom_name' => $request->input('symptom_name'),
                'medicine_name' => $request->input('medicine_name'),
                'medicine_days' => $request->input('medicine_days'),
                'medicine_morning' => $request->input('medicine_morning'),
                'medicine_afternoon' => $request->input('medicine_afternoon'),
                'medicine_evening' => $request->input('medicine_evening'),
                'medicine_night' => $request->input('medicine_night'),
                'medicine_continues' => $request->input('medicine_continues')
            );
            Medicine::create($attribute);
            return response()->json(['status' => true, 'message' => 'data insert success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Medicine $medicine): JsonResponse
    {
        try {
            $med = Medicine::findOrfail($medicine->id);
            return response()->json($med);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }


    public function edit(Medicine $medicine)
    {
        //
    }


    public function update(Request $request, Medicine $medicine): JsonResponse
    {
        $validate = Validator::make($request->all(),[
            'medicine_name' => 'required',
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
                $medicineResponse = Medicine::findOrFail($medicine);
                $attribute = array(
                    'symptom_name' => $request->input('symptom_name'),
                    'medicine_name' => $request->input('medicine_name'),
                    'medicine_days' => $request->input('medicine_days'),
                    'medicine_morning' => $request->input('medicine_morning'),
                    'medicine_afternoon' => $request->input('medicine_afternoon'),
                    'medicine_evening' => $request->input('medicine_evening'),
                    'medicine_night' => $request->input('medicine_night'),
                    'medicine_continues' => $request->input('medicine_continues')
                );
                $medicineResponse->update($attribute);
                return response()->json(['status' => true, 'message' => 'data insert success']);
            } catch (ModelNotFoundException $exception) {
                return response()->json('not found model');
            }
        }
    }


    public function destroy(Medicine $medicine): JsonResponse
    {
        Medicine::destroy($medicine->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
