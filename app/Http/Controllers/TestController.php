<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Test::all();
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
            'tests_name'=> 'required',
        ]);

        if ($validate->fails()){
            return response()->json(['status' => false , 'message' => $validate->errors(), 'data' => $request]);
        }else{
            return response()->json(['status' => true , 'message' => 'success']);

        }

        $tes = new Test;
        $tes->tests_name = $request->tests_name;

        $tes->save();
        return response()->json(['status'=>true, 'message'=>'data stored successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test): \Illuminate\Http\JsonResponse
    {
        try {
            $tes = Test::findOrfail($test);
        }
        catch (ModelNotFoundException $exception){
            return response()->json(['Not found'], 404);
        }
        return $tes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test): \Illuminate\Http\JsonResponse
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
            }
            catch (ModelNotFoundException $exception){
                return response()->json('not found model');
            }
        }

        $tes = new Test;
        $tes->tests_name = $request->tests_name;

        $tes->save();
        return response()->json('done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test): \Illuminate\Http\JsonResponse
    {
        Test::destroy($test->id);
        return response()->json(['status'=>true, 'message'=>'delete successfull']);
    }
}
