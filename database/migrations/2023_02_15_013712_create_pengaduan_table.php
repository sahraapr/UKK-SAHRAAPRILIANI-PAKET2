<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->datetime('tgl_pengaduan');
            $table->string('nik', 16);
            $table->text('judul_laporan');
            $table->text('isi_laporan');
            $table->foreignId('id_kategori')
                ->constrained('kategori')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('foto');
            $table->enum('privasi', ['rahasia', 'publik'])->default('publik');
            $table->enum('status', ['0', 'proses', 'selesai', 'ditolak'])->default(0);
            $table->text('alasan_ditolak')->nullable();
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
        Schema::dropIfExists('pengaduan');
    }
}
