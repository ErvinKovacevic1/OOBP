<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarudzbeTable extends Migration
{
    public function up()
    {
        Schema::create('narudzbe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('artikli'); // Čuvanje artikala kao JSON string
            $table->decimal('ukupno', 8, 2);
            $table->string('nacin_preuzimanja');
            $table->string('status')->default('u procesu');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('narudzbe');
    }
}
