<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Test::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        //validation
        $validate = Validator::make($request->all(),[
            'tests_name'=> 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            Test::create([
                'tests_name' => $request->input('tests_name')
            ]);
            return response()->json(['status'=>true, 'message'=>'data stored successfully']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return JsonResponse
     */
    public function show(Test $test): JsonResponse
    {
        try {
          return response()->json(Test::findOrFail($test->id));
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Test $test
     * @return void
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Test $test
     * @return JsonResponse
     */
    public function update(Request $request, Test $test): JsonResponse
    {
        //validation
        $validate = Validator::make($request->all(),[
            'tests_name'=> 'required',
        ]);

        if ($validate->fails()){
            return response()->json($validate->errors());
        }else{
            try {
                $tes = Test::findOrfail($test->id);
                $tes->update([
                    'tests_name' => $request->input('tests_name')
                ]);
                return response()->json('done');
            }
            catch (ModelNotFoundException $exception){
                return response()->json('not found model');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Test $test
     * @return JsonResponse
     */
    public function destroy(Test $test): JsonResponse
    {
        Test::destroy($test->id);
        return response()->json(['status'=>true, 'message'=>'delete successful']);
    }
}
