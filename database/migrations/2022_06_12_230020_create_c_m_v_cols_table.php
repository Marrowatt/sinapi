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
        Schema::create('c_m_v_cols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id')->constrained();
            $table->double('humidity_percents', 8, 3)->nullable();
            $table->double('energy_kcal', 8, 3)->nullable();
            $table->double('energy_kj', 8, 3)->nullable();
            $table->double('protein_g', 8, 3)->nullable();
            $table->double('lipidius_g', 8, 3)->nullable();
            $table->double('cholesterol_mg', 8, 3)->nullable();
            $table->double('carbohydrate_g', 8, 3)->nullable();
            $table->double('fiber_g', 8, 3)->nullable();
            $table->double('ashes_g', 8, 3)->nullable();
            $table->double('calcium_mg', 8, 3)->nullable();
            $table->double('magnesium_mg', 8, 3)->nullable();
            $table->double('manganese_mg', 8, 3)->nullable();
            $table->double('phosphorus_mg', 8, 3)->nullable();
            $table->double('iron_mg', 8, 3)->nullable();
            $table->double('sodium_mg', 8, 3)->nullable();
            $table->double('potassium_mg', 8, 3)->nullable();
            $table->double('copper_mg', 8, 3)->nullable();
            $table->double('zinc_mg', 8, 3)->nullable();
            $table->double('retinol_mcg', 8, 3)->nullable();
            $table->double('re_mcg', 8, 3)->nullable();
            $table->double('rae_mcg', 8, 3)->nullable();
            $table->double('tiamina_mg', 8, 3)->nullable();
            $table->double('riboflavin_mg', 8, 3)->nullable();
            $table->double('pyridoxine_mg', 8, 3)->nullable();
            $table->double('niacin_mg', 8, 3)->nullable();
            $table->double('vitaminC_mg', 8, 3)->nullable();
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
        Schema::dropIfExists('c_m_v_cols');
    }
};
