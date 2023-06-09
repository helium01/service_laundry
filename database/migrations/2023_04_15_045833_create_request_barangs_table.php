<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_barangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('status');
            $table->string('jenis_servis');
            $table->integer('jenis_paket');
            $table->integer('jumlah_barang');
            $table->varchar('kode_kupon');
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
        Schema::dropIfExists('request_barangs');
    }
};
