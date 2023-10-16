<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->increments('kd_transaksi_detail');
            $table->unsignedInteger('kd_transaksi');
            $table->foreign('kd_transaksi')->references('kd_transaksi')->on('transaksi');
            $table->unsignedInteger('kd_produk');
            $table->foreign('kd_produk')->references('kd_produk')->on('produk');
            $table->integer('jumlah');
            $table->integer('harga');
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
        Schema::create('transaksi_detail', function (Blueprint $table) {
          $table->dropForeign(['no_faktur']);
          $table->dropForeign(['kd_produk']);
        });
        Schema::dropIfExists('transaksi_detai');
    }
}
