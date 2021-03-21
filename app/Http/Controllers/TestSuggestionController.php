<?php

namespace App\Http\Controllers;

use App\Models\Test_Suggestion;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Test_Suggestion::all();
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
            'symptom_name' => 'required',
            'tests_name' => 'required',
            'ts_score' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            return response()->json(['status' => true , 'message' => 'success']);
        }

        $tes = new Test_Suggestion;

        $tes->symptom_name = $request->symptom_name;
        $tes->tests_name = $request->tests_name;
        $tes->ts_score = 0;

        $tes->save();
        return response()->json(['status'=>true, 'message'=>'data stored successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test_Suggestion  $test_Suggestion
     * @return \Illuminate\Http\Response
     */
    public function show(Test_Suggestion $test_Suggestion): \Illuminate\Http\JsonResponse
    {
        try {
            $tes = Test_Suggestion::findOrfail($test_Suggestion->id);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
        return $tes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test_Suggestion  $test_Suggestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Test_Suggestion $test_Suggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test_Suggestion  $test_Suggestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test_Suggestion $test_Suggestion): \Illuminate\Http\JsonResponse
    {
        //validation
        $validate = Validator::make($request->all(),[
            'symptom_name' => 'required',
            'tests_name' => 'required',
            'ts_score' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json( $validate->errors());
        }else{
            try {
                $tes = Test_Suggestion::findOrfail($test_Suggestion->id);
            }catch (ModelNotFoundException $exception){
                return response()->json('not found model');
            }
        }

        $tes->symptom_name = $request->symptom_name;
        $tes->tests_name = $request->tests_name;
        $tes->ts_score = 0;

        $tes->save();
        return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test_Suggestion  $test_Suggestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test_Suggestion $test_Suggestion): \Illuminate\Http\JsonResponse
    {
        Test_Suggestion::destroy($test_Suggestion->id);
        return response()->json(['status'=>true, 'message'=>'delete successfull']);
    }
}
