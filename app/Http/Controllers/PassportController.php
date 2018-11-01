<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PassportController extends Controller
{
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        
        //make login
        if (auth()->attempt($request->all())){
            $token = auth()->user()->createToken('mandala')->accessToken;
            return response()->json(['token'=>$token],200);
        } else {
            return response()->json(['error'=>'UnAuthorised'],401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(){
        return response()->json(auth()->user(),200);
    }

    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        //validate request
        $this->validate($request, [
            'name'=>'required|min:3',
            'password'=>'required|min:6',
            'email'=>'required|email'
        ]);

        $user = User::create($request->all());

        $token = $user->createToken('mandala')->accessToken;

        return response()->json(['token'=>$token],201);
    }

}
