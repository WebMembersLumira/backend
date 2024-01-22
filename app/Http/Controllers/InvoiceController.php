<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Member;

class InvoiceController extends Controller
{
    public function listInvoice()
    {
        $data = Invoice::with('user:id,name,no_hp')->get();
    
        return $data
            ? response()->json(['data' => $data, 'status' => true])
            : response()->json(['status' => false]);
    }

    public function listInvoiceByStatus($status)
    {
        $data = Invoice::with('user:id,name,no_hp')->where('status', $status)->get();

        if ($data->isNotEmpty()) {
            return response()->json(['data' => $data, 'status' => true]);
        } else {
            return response()->json(['message' => 'Tidak ada data ditemukan.', 'data' => []]);
        }
    }


    public function listInvoiceByUserId($id)
    {
        $data = Invoice::where('user_id', $id)->get();

        return $data
            ? response()->json(['data' => $data, 'status' => true])
            : response()->json(['status' => false]);
    }



    public function detailInvoice($id)
    {
        $data = Invoice::find($id);
        return $data
            ? response()->json(['data' => $data, 'status' => true])
            : response()->json(['status' => false]);
    }

    public function createInvoice(Request $request)
    {
        $validateData = $request->validate([
            'nomor_rekening' => 'required|numeric',
            'jumlah_transfer' => 'required|numeric',
            'bukti_transfer' => 'required|image',
            'user_id' => 'required|numeric',
        ]);
    
        // Cek apakah invoice sudah ada
        $invoice = Invoice::where('user_id', $validateData['user_id'])->first();
    
        if ($invoice) {
            // Jika invoice ada, update data
    
            // Update data Invoice
            $invoice->nomor_rekening = $validateData['nomor_rekening'];
            $invoice->jumlah_transfer = $validateData['jumlah_transfer'];
            $invoice->status = '0';
            $invoice->user_id = $validateData['user_id'];
    
            // Jika ada bukti transfer baru, simpan yang baru dan hapus yang lama
            if ($request->hasFile('bukti_transfer')) {
                $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
                $invoice->bukti_transfer = $buktiTransferPath;
            }
    
            $updated = $invoice->saveOrFail();
    
            return $updated
                ? response()->json(['message' => 'Invoice updated successfully', 'status' => true])
                : response()->json(['message' => 'Failed to update Invoice', 'status' => false]);
    
        } else {
            // Jika invoice tidak ada, buat baru
    
            // Simpan bukti transfer
            $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
    
            // Buat objek Invoice dan isi data
            $newInvoice = new Invoice();
            $newInvoice->nomor_rekening = $validateData['nomor_rekening'];
            $newInvoice->jumlah_transfer = $validateData['jumlah_transfer'];
            $newInvoice->bukti_transfer = $buktiTransferPath;
            $newInvoice->user_id = $validateData['user_id'];
    
            // Simpan data Invoice
            $saved = $newInvoice->saveOrFail();
    
            return $saved
                ? response()->json(['message' => 'Invoice created successfully', 'status' => true])
                : response()->json(['message' => 'Failed to create Invoice', 'status' => false]);
        }
    }
    

    public function updateInvoice(Request $request, $id)
    {
        $validateData = $request->validate([
            'nomor_rekening' => 'required|numeric',
            'jumlah_transfer' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        $invoice = Invoice::find($id);

        if ($invoice) {
            // Update data Invoice
            $invoice->nomor_rekening = $validateData['nomor_rekening'];
            $invoice->jumlah_transfer = $validateData['jumlah_transfer'];
            $invoice->user_id = $validateData['user_id'];

            // Jika ada bukti transfer baru, simpan yang baru dan hapus yang lama
            if ($request->hasFile('bukti_transfer')) {
                $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer', 'public');
                $invoice->bukti_transfer = $buktiTransferPath;
            }

            $updated = $invoice->save();

            return $updated
                ? response()->json(['message' => 'Invoice updated successfully', 'status' => true])
                : response()->json(['message' => 'Failed to update Invoice', 'status' => false]);
        }

        return response()->json(['message' => 'Invoice not found', 'status' => false]);
    }

    public function aturTanggal(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required',
            'invoice_id' => 'required',
            'tanggal_berakhir' => 'required',
        ]);

         // Ambil data invoice
        $invoice = Invoice::find($validateData['invoice_id']);
        // Periksa apakah invoice ditemukan
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }
        // Update status invoice
        $invoice->status = '1';
        $invoice->save();

         // Ambil data invoice
         $user = User::find($validateData['user_id']);
         // Periksa apakah invoice ditemukan
         if (!$user) {
             return response()->json(['message' => 'User not found'], 404);
         }
         // Update status invoice
         $user->tanggal_berakhir = $validateData['tanggal_berakhir'];
         $user->status = '2';
         $user->save();

         return response()->json([
            'message' => 'success',
            'status' => true
         ]);
    }

    public function actionInvoice(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required',
            'invoice_id' => 'required',
            'status_invoice' => 'required',
            'tanggal_berakhir' => 'required_if:status_invoice,1'
        ]);        
    
        // Ambil user dan invoice
        $user = User::find($validateData['user_id']);
        $invoice = Invoice::find($validateData['invoice_id']);
    
        // Pastikan user dan invoice ada
        if (!$invoice || !$user) {
            return response()->json(['error'=>'data not found!']);
        }
    
        // Update status invoice
        $invoice->status = $validateData['status_invoice'];
        $invoice->saveOrFail();
    
        // Jika invoice di acc
        if ($validateData['status_invoice'] == '1') {
            // Ambil atau buat data member
            $member = Member::where('user_id', $validateData['user_id'])->first();
            if (!$member) {
                $member = new Member();
            }
    
            // Masukkan data
            $member->status = 'true';
            $member->tanggal_berakhir = $validateData['tanggal_berakhir'];
            $invoice->tanggal_berakhir = $validateData['tanggal_berakhir'];
            $member->user_id = $validateData['user_id'];
            $member->saveOrFail();
            $invoice->saveOrFail();
        }
    
        // Jika invoice ditolak
        if ($validateData['status_invoice'] == '2') {
            // Ambil data member yang user id-nya sama
            $member = Member::where('user_id', $validateData['user_id'])->first();
    
            // Jika terdapat data member, ubah datanya
            if ($member && $member->exists) {                
                $member->status = 'false';
                $member->tanggal_berakhir = '2023-01-01';
                $member->user_id = $validateData['user_id'];
                $member->saveOrFail();
            }
        }
        
        return response()->json(['message'=>'action invoice successfully!']);
    }

    public function setExpiredMemberDate()
    {
    }
    
    public function checkMembership($id)
    {
        $memberData = Member::where('user_id', $id)->get();

        if (count($memberData) >0) {
            return response()->json(['message'=> 'success', 'data'=> $memberData]);
        }
        return response()->json(['message'=> 'failed', 'status' => 401]);
    }

    public function getJumlahInvoice()
    {
        $jumlahPending = Invoice::where('status', '0')->count();
        $jumlahActive = Invoice::where('status', '1')->count();
        $jumlahReject = Invoice::where('status', '2')->count();
        $jumlahExpired = Invoice::where('status', '3')->count();
        $jumlahPerpanjangan = Invoice::where('status', '4')->count();

        return response()->json([
            'jumlahPending' => $jumlahPending,
            'jumlahActive' => $jumlahActive,
            'jumlahReject' => $jumlahReject,
            'jumlahExpired' => $jumlahExpired,
            'jumlahPerpanjangan' => $jumlahPerpanjangan,
        ]);
    }
}
