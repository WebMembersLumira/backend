<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DateTimeZone;
use DateTime;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\EmailController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|numeric|unique:users',
            'metode_pembayaran' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'metode_pembayaran' => $request->input('metode_pembayaran'),
        ]);

        if ($user) {
            // $this->emailController->index($user->id);
            Mail::to($user->email)->send(new SendEmail($user->id));
            // Mail::to($user->email)->send(new EmailVerification($user));
            return response()->json(['message' => 'Registration successful', 'id' => $user->id],201);
        } else {
            return response()->json(['message' => 'Registration failed'], 500);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        // $now = Carbon::now(); 
        $user = User::where('email', request('email'))->first();
        if ($user->status === '0') {
            return response()->json(['error' => 'anda belum verifikasi akun!!']);
        }
        

        $credentials = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        $customClaims = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'level' => $user->level,
            'tanggal_berakhir' => $user->tanggal_berakhir,
            'status' => $user->status,
        ];

        $tokenWithClaims = JWTAuth::claims($customClaims)->fromUser($user);

        return $this->respondWithToken($tokenWithClaims);
    }

    public function listUser()
    {
        $users = User::get();

        return response()->json([
            'data' => $users,
            'message' => 'successfully'
        ]);
    }

    public function resetPassword(Request $request, $id)
    {
        $validateData = $request->validate([
            "name" => "required",
            "email" => "required",
            'no_hp' => 'required',
            'metode_pembayaran' => 'required',
            "password" => "required",
        ]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'data not found']);
        }

        $user->name = $validateData['name'];
        $user->email = $validateData['email'];
        $user->no_hp = $validateData['no_hp'];
        $user->password = $validateData['password'];
        $user->metode_pembayaran = $validateData['metode_pembayaran'];

        $user->save();

        return response()->json(['message' => 'update users successfully']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'sub' => auth()->user()->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'level' => auth()->user()->level,
            'status' => auth()->user()->status,
            'iat' => now()->timestamp,
            'token_type' => 'bearer',
            'expires_in' =>  auth()->factory()->getTTL() * 60,
        ]);
    }
    
    

}
