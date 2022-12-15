<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    //
    //register
    //  /**
    //  * @OA\Post(
    //  ** path="/api/register",
    //  *   tags={"Auth"},
    //  *   summary="Register",
    //  *   operationId="register",
    //  *
    //  *  @OA\Parameter(
    //  *      name="name",
    //  *      in="query",
    //  *      required=true,
    //  *      @OA\Schema(
    //  *           type="string"
    //  *      )
    //  *   ),
    //  *  @OA\Parameter(
    //  *      name="email",
    //  *      in="query",
    //  *      required=true,
    //  *      @OA\Schema(
    //  *           type="string"
    //  *      )
    //  *   ),
    //  *   @OA\Parameter(
    //  *      name="password",
    //  *      in="query",
    //  *      required=true,
    //  *      @OA\Schema(
    //  *           type="string"
    //  *      )
    //  *   ),
    //  *      @OA\Parameter(
    //  *      name="password_confirmation",
    //  *      in="query",
    //  *      required=true,
    //  *      @OA\Schema(
    //  *           type="string"
    //  *      )
    //  *   ),
    //  *   @OA\Response(
    //  *      response=201,
    //  *       description="Success",
    //  *      @OA\MediaType(
    //  *           mediaType="application/json",
    //  *      )
    //  *   ),
    //  *   @OA\Response(
    //  *      response=401,
    //  *       description="Unauthenticated"
    //  *   ),
    //  *   @OA\Response(
    //  *      response=400,
    //  *      description="Bad Request"
    //  *   )
    //  *)
    //  **/
   
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('token-name', ['server:update'])->plainTextToken;

        return response()->json([
            'message' => 'Berhasil Register',
            'data' => $user,
            'token' => $token
        ],200);
    }
     // login
    /**
     * @OA\Post(
     ** path="/api/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = User::where('email', $request->email)->first();
            //create token
            $token = $user->createToken('token-name', ['server:update'])->plainTextToken;

            return response()->json([
                'message' => 'Berhasil Login',
                'data' => $user,
                'token' => $token
            ],200);

            // dd('ada data');
        }else{
            return response()->json([
                'message' => 'Email atau Password Salah'
            ],401);
            // dd('tidak ada data');
        }
    }
    // logout 
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     operationId="Logout",
     *     security={{"Bearer":{}}},
    *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     * )
     */
    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil Logout',
        ],200);

        // dd('berhasil keluar');
    }
}
