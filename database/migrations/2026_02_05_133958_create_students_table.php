<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('studenti', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 60);
            $table->string('prezime', 80);
            $table->date('datum_rod');
            $table->integer('mbr');
            $table->decimal('stipendija', 10, 2)->default(0);
            $table->string('mjesto', 80)->nullable(); // BITNO: može biti null zbog middleware zadatka
            $table->unsignedBigInteger('fakultetid');       
            $table->foreign('fakultetid')->references('id')->on('fakulteti')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studenti');
    }
};
