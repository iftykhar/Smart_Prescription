<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Exception;

class AuthController extends Controller
{

    #[ArrayShape(['status' => "bool", 'message' => "\Illuminate\Support\MessageBag|string"])] public function register(Request $request): array
    {
        $validationStatus = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed'
        ]);



        try {
            if ($validationStatus->fails()){
                $response = [
                    'status' => false,
                    'message' => $validationStatus->errors()
                ];
            }else{
                $attributes = $request->all();
                $attributes['password'] = Hash::make($request->input('password'));
                $attributes['password_confirmation'] = Hash::make($request->input('password_confirmation'));
                if (User::create($attributes)){
                    $response = [
                        'status' => true,
                        'message' => 'success'
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'something is wrong'
                    ];
                }
            }
        }catch (Exception $exception){
            $response = [
                'status' => false,
                'message' => $exception->getMessage()
            ];
        }
        return $response;
    }

    #[ArrayShape(['status' => "bool", 'message' => "\Illuminate\Support\MessageBag|string", 'token' => "mixed"])] public function login(Request $request): array
    {
        $status = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($status->fails()){
            $response = [
                'status' => false,
                'message' => $status->errors()
            ];
        }else{
            try
            {
                if(Auth::attempt($request->all(['email', 'password']))){
                    $response = [
                        'status' => true,
                        'message' => "success",
                        'token' => Auth::user()->createToken('authToken')->plainTextToken
                    ];
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Incorrect user or password'
                    ];
                }
            }catch (Exception $exception){
                $response = [
                    'status' => false,
                    'message' => $exception->getMessage()
                ];
            }

        }
        return $response;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
