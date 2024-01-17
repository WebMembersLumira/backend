<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\User;

class EmailController extends Controller
{

    // api
    public function index($id)
    {
        // Mengambil pengguna dengan ID yang sesuai dan status 0
        $user = User::where('id', $id)
                    ->where('status', '0')
                    ->first();
    
        // Memeriksa apakah pengguna ditemukan
        if (!$user) {
            return response()->json([
                "message" => "User not found or status is not 0",
                "code" => 404
            ]);
        }
    
        // Mengirim email kepada pengguna
        Mail::to($user->email)->send(new SendEmail($user));
    
        return response()->json([
            "message" => "Email sent successfully",
            "code" => 200
        ]);
    }

    
        // web
    public function password($id)
    {
        $id = base64_decode($id);
        return view('verifikasi', compact('id'));
        // return $id;
    }

    public function profile()
    {
        return view('profile');
    }

    public function aktivasi(Request $request)
    {
        $user = User::find($request->id);
        if ($user->status === '1') {
            return "akun sudah di aktivasi sebelumnya!!";
        }
        $user->password = bcrypt($request->password);
        $user->status = '1';
        $user->save();

        // alihkan ke vue js
        return 'aktivasi akun berhasil, silahkan login di aplikasi!';
    }
}
