<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Langganan;
use App\Models\Invoice;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'no_hp' => '79079070s',
            'level' => '0',
            'status' => '1',
            'password' => Hash::make('12345'),
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'no_hp' => '79079070s',
            'level' => '1',
            'status' => '1',
            'password' => Hash::make('12345'),
        ]);
        Langganan::create([
            'jenis_langganan' => 'satu',
            'harga' => '123'
        ]);
        Langganan::create([
            'jenis_langganan' => 'dua',
            'harga' => '1234'
        ]);
        Invoice::create([
            'nama_pengirim' => 'John Doe',
            'nomor_rekening' => '1234567890',
            'jumlah_transfer' => 100000,
            'bukti_transfer' => 'bukti_transfer_1.jpg',
            'status' => '0',
            'tanggal_berakhir' => '2024/02/01',
            'user_id' => 2,
            'langganan_id' => 1,
        ]);
        Invoice::create([
            'nama_pengirim' => 'Jane Doe',
            'nomor_rekening' => '0987654321',
            'jumlah_transfer' => 200000,
            'bukti_transfer' => 'bukti_transfer_2.jpg',
            'status' => '2',
            'tanggal_berakhir' => '2024/02/01',
            'user_id' => 1,
            'langganan_id' => 2,
        ]);
        Invoice::create([
            'nama_pengirim' => 'Jane Doe',
            'nomor_rekening' => '0987654321',
            'jumlah_transfer' => 200000,
            'bukti_transfer' => 'bukti_transfer_2.jpg',
            'status' => '2',
            'tanggal_berakhir' => '2024/02/01',
            'user_id' => 1,
            'langganan_id' => 2,
        ]);
        Invoice::create([
            'nama_pengirim' => 'Jane Doe',
            'nomor_rekening' => '0987654321',
            'jumlah_transfer' => 200000,
            'bukti_transfer' => 'bukti_transfer_2.jpg',
            'status' => '2',
            'tanggal_berakhir' => '2024/02/01',
            'user_id' => 1,
            'langganan_id' => 2,
        ]);
    }
}
