<?php

namespace App\Http\Controllers;

use App\Models\Test_Suggestion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Test_Suggestion::all());
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
            'symptom_name' => 'required',
            'tests_name' => 'required',
            'ts_score' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            Test_Suggestion::create([
                'symptom_name' => $request->input('symptom_name'),
                'tests_name' => $request->input('tests_name'),
                'ts_score' => 0
            ]);
            return response()->json(['status'=>true, 'message'=>'data stored successfully']);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param Test_Suggestion $test_Suggestion
     * @return JsonResponse
     */
    public function show(Test_Suggestion $test_Suggestion): JsonResponse
    {
        try {
            return response()->json(Test_Suggestion::findOrFail($test_Suggestion->id));
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Test_Suggestion $test_Suggestion
     * @return void
     */
    public function edit(Test_Suggestion $test_Suggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Test_Suggestion $test_Suggestion
     * @return JsonResponse
     */
    public function update(Request $request, Test_Suggestion $test_Suggestion): JsonResponse
    {
        $validate = Validator::make($request->all(),[
            'symptom_name' => 'required',
            'tests_name' => 'required',
            'ts_score' => 'required',
        ]);

        if ($validate->fails()){
            return response()->json($validate->errors());
        }else{
            try {
                $tes = Test_Suggestion::findOrFail($test_Suggestion->id);
                $tes->update([
                    'symptom_name' => $request->input('symptom_name'),
                    'tests_name' => $request->input('symptom_name'),
                    'ts_score' => 0
                ]);
                return response()->json('Data update success');

            }catch (ModelNotFoundException $exception){
                return response()->json('not found model');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Test_Suggestion $test_Suggestion
     * @return JsonResponse
     */
    public function destroy(Test_Suggestion $test_Suggestion): JsonResponse
    {
        Test_Suggestion::destroy($test_Suggestion->id);
        return response()->json(['status'=>true, 'message'=>'delete successful']);
    }
}
