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
        Schema::create('reunions', function (Blueprint $table) {
            $table->id();
            $table->string('objet');
            $table->text('details')->nullable();
            $table->unsignedBigInteger('id_organs');
            $table->foreign('id_organs')
                  ->references('id')
                  ->on('organs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->date('date_reunion');
            $table->string('salle');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reunions');
    }
};
