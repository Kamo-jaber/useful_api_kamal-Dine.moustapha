<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //Register
    public function addusers(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns', 'max:255', 'unique:'.User::class],
            'password' => ['required',  'min:8'],
        ]);

        //insertion dans la base de donner

        if ($validator->fails()) {

            return response()->json([
                "message"=> "User error: Bad params"
            ], 400);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->string('password')),
            ]);

            return response()->json([
                "data" => $user
            ], 201);

            // $responseUser = User::where("email", "=", $request->email)->first();

            // event(new Registered($user));

            // Auth::login($user);

            // $token = $user->createToken('access_token');

            // return response()->json([
            //     "access_token"=> $token->plainTextToken,
            //     "user" => $responseUser
            // ], 201);
        }
    }

     public function login(Request $request): JsonResponse
    {

        $validate = Validator::make($request->all(), [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:8'],
        ]);

        if (!$validate) {

            return response()->json([
                "message"=> "User error: Bad params"
            ], 401);
        } else {

            $user = User::where("email", "=", $request->email)->first();

            if ($user) {

                if (!Hash::check($request->password, $user->password)) {

                    return response()->json([
                        "message"=> "User error: Bad params"
                    ], 401);
                }

                $token = $user->createToken("access_token");

                return response()->json([
                    "access_token"=>$token->plainTextToken,
                    "user_id"=>$user->id,
                ], 200);
            } else {

                return response()->json([
                    "message"=> "User error: Bad params"
                ], 400);
            }
        }

    }
}


