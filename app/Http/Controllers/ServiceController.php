<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Transaksi;
use App\Models\Langganan;
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

    public function setRekening(Request $request)
    {
        $validateData = $request->validate([
            'rekening_tujuan' => 'required',
        ]);
    
        $transaksi = Transaksi::first();
    
        if (!$transaksi) {
            // Buat link baru jika tidak ditemukan
            $transaksi = new Transaksi();
        }
    
        $transaksi->rekening_tujuan = $validateData['rekening_tujuan'];
        $transaksi->save();
    
        return response()->json(['message' => 'data rekening berhasil disimpan']);
    }

    public function getRekening()
    {
        $rekening = Transaksi::first();

        if (!$rekening) {
            return response()->json(['message' => 'no data found']);
        }
        return response()->json(['message' => 'success', 'data' => $rekening]);
    }

    public function setJenisLangganan(Request $request)
    {
        $validateData = $request->validate([
            'jenis_langganan' => 'required',
            'harga' => 'required'
        ]);

        $langganan = New Langganan();
        $langganan->jenis_langganan = $validateData['jenis_langganan'];
        $langganan->harga = $validateData['harga'];
        $langganan->save();

        return response()->json(['message' => 'success'],201);
    }
    
    public function listJenisLangganan()
    {
        $result = Langganan::get();
        return response()->json(['message' => 'success', 'data' => $result],200);
    }
}
