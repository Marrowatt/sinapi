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
            $table->foreignId('variation_id')->constrained();
            $table->double('saturated_g', 5, 3)->nullable();
            $table->double('monounsaturated_g', 5, 3)->nullable();
            $table->double('polyunsaturated_g', 5, 3)->nullable();
            $table->double('12:0_g', 5, 3)->nullable();
            $table->double('14:0_g', 5, 3)->nullable();
            $table->double('16:0_g', 5, 3)->nullable();
            $table->double('18:0_g', 5, 3)->nullable();
            $table->double('20:0_g', 5, 3)->nullable();
            $table->double('22:0_g', 5, 3)->nullable();
            $table->double('24:0_g', 5, 3)->nullable();
            $table->double('14:1_g', 5, 3)->nullable();
            $table->double('16:1_g', 5, 3)->nullable();
            $table->double('18:1_g', 5, 3)->nullable();
            $table->double('20:1_g', 5, 3)->nullable();
            $table->double('18:2 n-6_g', 5, 3)->nullable();
            $table->double('18:3 n-3_g', 5, 3)->nullable();
            $table->double('20:4_g', 5, 3)->nullable();
            $table->double('20:5_g', 5, 3)->nullable();
            $table->double('22:5_g', 5, 3)->nullable();
            $table->double('22:6_g', 5, 3)->nullable();
            $table->double('18:1t_g', 5, 3)->nullable();
            $table->double('18:2t_g', 5, 3)->nullable();
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
