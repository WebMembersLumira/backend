<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengirim');
            $table->string('nomor_rekening');
            $table->integer('jumlah_transfer');
            $table->string('bukti_transfer');
            $table->enum('status',[
                '0', // invoice baru / pending
                '1', // active
                '2', // reject
                ])->default('0');
                $table->date('tanggal_berakhir')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('langganan_id')->constrained('langganans')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('langganan_id')->nullable()->constrained('langganans')->onDelete('set null')->onUpdate('cascade');
            // $table->foreignId('langganan_id')->constrained('langganans')->restrictOnDelete()->onUpdate('cascade');
            $table->foreignId('langganan_id')->nullable()->constrained('langganans')->nullOnDelete()->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
