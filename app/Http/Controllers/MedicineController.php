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

    }

    public function store(Request $request): JsonResponse
    {
        //validate
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
        }else {
            return response()->json(['status' => true, 'message' => 'success']);

            $med = new Medicine;

            $med->symptom_name = $request->symptom_name;
            $med->medicine_name = $request->medicine_name;
            $med->medicine_days = $request->medicine_days;
            $med->medicine_morning = $request->medicine_morning;
            $med->medicine_afternoon = $request->medicine_afternoon;
            $med->medicine_evening = $request->medicine_evening;
            $med->medicine_night = $request->medicine_night;
            $med->medicine_continues = $request->medicine_continues;

            $med->save();
            return response()->json(['status' => true, 'message' => 'data insert success']);
        }
    }

    public function show(Medicine $medicine): JsonResponse
    {
        //
        try {
            $med = Medicine::findOrfail($medicine->id);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
        return $med;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine): \Illuminate\Http\JsonResponse
    {
        //
        //validate
        $validate = Validator::make($request->all(),[
            'medicine_name' => 'required',
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
                $med = Medicine::findOrfail($medicine->id);
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

            $med->save();
            return response()->json(['status' => true, 'message' => 'data insert success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine): \Illuminate\Http\JsonResponse
    {
        //
        Medicine::destroy($medicine->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
