<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Validation\Rule;


class ServiceController extends Controller
{
    public function getLink()
    {
        $service = Service::get();

        return response()->json([
            'data' => $service,
            'message' => 'successfully'
        ]);
    }

    public function setLink(Request $request)
    {
        $validateData = $request->validate([
            'judul' => 'required',
            'link' => ['required', Rule::unique('services', 'link')->ignore(Service::class)]
        ]);
    
        $service = Service::first();
    
        if (!$service) {
            // Buat link baru jika tidak ditemukan
            $service = new Service();
        }
    
        $service->judul = $validateData['judul'];
        $service->link = $validateData['link'];
        $service->save();
    
        return response()->json(['message' => 'Link berhasil disimpan']);
    }
}
