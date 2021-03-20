<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Medicine::all();
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
        }else{
            return response()->json(['status' => true , 'message' => 'success']);

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
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
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            try {
                $doc = Medicine::findOrfail($medicine);
            }catch (ModelNotFoundException $exception){
                return response()->json('not found model');
            }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
        Medicine::destroy($medicine->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
