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
        Schema::create('aminoacids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_id')->constrained();
            $table->double('tryptophan_g', 5, 3)->nullable();
            $table->double('threonine_g', 5, 3)->nullable();
            $table->double('isoleucine_g', 5, 3)->nullable();
            $table->double('leucine_g', 5, 3)->nullable();
            $table->double('lysine_g', 5, 3)->nullable();
            $table->double('methionine_g', 5, 3)->nullable();
            $table->double('cystine_g', 5, 3)->nullable();
            $table->double('phenylalanine_g', 5, 3)->nullable();
            $table->double('tyrosine_g', 5, 3)->nullable();
            $table->double('valine_g', 5, 3)->nullable();
            $table->double('arginine_g', 5, 3)->nullable();
            $table->double('histidine_g', 5, 3)->nullable();
            $table->double('alanine_g', 5, 3)->nullable();
            $table->double('aspartic_g', 5, 3)->nullable();
            $table->double('glutamic_g', 5, 3)->nullable();
            $table->double('glycine_g', 5, 3)->nullable();
            $table->double('proline_g', 5, 3)->nullable();
            $table->double('serine_g', 5, 3)->nullable();
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
        Schema::dropIfExists('aminoacids');
    }
};
