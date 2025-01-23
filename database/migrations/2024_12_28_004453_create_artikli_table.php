<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikliTable extends Migration
{
    public function up()
    {
        Schema::create('artikli', function (Blueprint $table) {
            $table->id();
            $table->string('naziv'); // Naziv artikla
            $table->text('opis')->nullable(); // Kratak opis artikla
            $table->decimal('cijena', 8, 2); // Cijena artikla
            $table->string('slika')->nullable(); // Putanja do slike
            $table->unsignedBigInteger('kategorije_id')->nullable(); // Povezana kategorija
            $table->integer('kolicina_na_stanju')->default(0); // Zaliha
            $table->timestamps();

            // Relacija s kategorijama
            $table->foreign('kategorije_id')->references('id')->on('kategorije')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('artikli');
    }
}
