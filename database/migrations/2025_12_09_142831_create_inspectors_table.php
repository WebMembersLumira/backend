<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama penyelia, contoh: "Ahmad Fadli, S.T."
            $table->string('title'); // Jabatan, contoh: "Penyelia Halal Ahli Madya"
            $table->string('image'); 
            $table->string('no_hp'); 
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
        Schema::dropIfExists('inspectors');
    }
}
