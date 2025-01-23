<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radnici', function (Blueprint $table) {
            $table->id();  // Automatski kreira ID polje
            $table->string('ime');  // Polje za ime radnika
            $table->string('prezime');  // Polje za prezime
            $table->string('email')->unique();  // Polje za email s jedinstvenim indeksom
            $table->string('telefon');  // Polje za telefon
            $table->string('adresa')->nullable();  // Polje za adresu, opcionalno
            $table->enum('status', ['aktivan', 'neaktivan'])->default('aktivan');  // Polje za status radnika
            $table->timestamps();  // Automatski kreira created_at i updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radnici');
    }
}
