<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarudzbaArtiklTable extends Migration
{
    public function up()
    {
        Schema::create('narudzba_artikl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('narudzba_id')->constrained()->onDelete('cascade');
            $table->foreignId('artikl_id')->constrained()->onDelete('cascade');
            $table->integer('kolicina');
            $table->decimal('cijena', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('narudzba_artikl');
    }
}
