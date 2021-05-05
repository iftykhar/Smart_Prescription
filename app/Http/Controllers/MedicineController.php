<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Medicine::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
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
            $attributes = array(
                'symptom_name' => $request->input('symptom_name'),
                'medicine_name' => $request->input('medicine_name'),
                'medicine_days' => $request->input('medicine_days'),
                'medicine_morning' => $request->input('medicine_morning'),
                'medicine_afternoon' => $request->input('medicine_afternoon'),
                'medicine_evening' => $request->input('medicine_evening'),
                'medicine_night' => $request->input('medicine_night'),
                'medicine_continues' => $request->input('medicine_continues')
            );
            Medicine::create($attributes);
            return response()->json(['status' => true, 'message' => 'data insert success']);
        }
    }

        /**
         * Display the specified resource.
         *
         * @param Medicine $medicine
         * @return JsonResponse
         */
    public function show(Medicine $medicine): JsonResponse
    {
        try {
            return Medicine::findOrfail($medicine->id);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }



        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param Medicine $medicine
         * @return JsonResponse
         */
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
            $attributes = array(
                'symptom_name' => $request->input('symptom_name'),
                'medicine_name' => $request->input('medicine_name'),
                'medicine_days' => $request->input('medicine_days'),
                'medicine_morning' => $request->input('medicine_morning'),
                'medicine_afternoon' => $request->input('medicine_afternoon'),
                'medicine_evening' => $request->input('medicine_evening'),
                'medicine_night' => $request->input('medicine_night'),
                'medicine_continues' => $request->input('medicine_continues')
            );


            $med->update($attributes);
            return response()->json(['status' => true, 'message' => 'data insert success']);
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param Medicine $medicine
         * @return JsonResponse
         */
    public function destroy(Medicine $medicine): JsonResponse
    {
        Medicine::destroy($medicine->id);
        return response()->json(['status' => true, 'message' => 'delete success']);
    }
}
