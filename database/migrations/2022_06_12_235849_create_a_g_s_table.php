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
        Schema::create('a_g_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->constrained();
            $table->double('saturated_g', 9, 4)->nullable();
            $table->double('monounsaturated_g', 9, 4)->nullable();
            $table->double('polyunsaturated_g', 9, 4)->nullable();
            $table->double('ag_12_0_g', 9, 4)->nullable();
            $table->double('ag_14_0_g', 9, 4)->nullable();
            $table->double('ag_16_0_g', 9, 4)->nullable();
            $table->double('ag_18_0_g', 9, 4)->nullable();
            $table->double('ag_20_0_g', 9, 4)->nullable();
            $table->double('ag_22_0_g', 9, 4)->nullable();
            $table->double('ag_24_0_g', 9, 4)->nullable();
            $table->double('ag_14_1_g', 9, 4)->nullable();
            $table->double('ag_16_1_g', 9, 4)->nullable();
            $table->double('ag_18_1_g', 9, 4)->nullable();
            $table->double('ag_20_1_g', 9, 4)->nullable();
            $table->double('ag_18_2_n_6_g', 9, 4)->nullable();
            $table->double('ag_18_3_n_3_g', 9, 4)->nullable();
            $table->double('ag_20_4_g', 9, 4)->nullable();
            $table->double('ag_20_5_g', 9, 4)->nullable();
            $table->double('ag_22_5_g', 9, 4)->nullable();
            $table->double('ag_22_6_g', 9, 4)->nullable();
            $table->double('ag_18_1t_g', 9, 4)->nullable();
            $table->double('ag_18_2t_g', 9, 4)->nullable();
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
        Schema::dropIfExists('a_g_s');
    }
};
