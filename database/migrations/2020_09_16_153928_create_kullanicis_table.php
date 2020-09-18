<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKullanicisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kullanicis', function (Blueprint $table) {
            $table->id();
            $table->string('adsoyad',60);
            $table->string('email',150)->unique();
            $table->string('sifre',60);
            $table->string('aktivasyon_anahtari',60)->nullable();
            $table->boolean('aktif_mi')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kullanicis');
    }
}
