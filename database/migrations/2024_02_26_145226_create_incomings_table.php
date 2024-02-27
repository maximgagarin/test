<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('areas_id');
            $table->string('number')->nullable();
            $table->decimal('sum_incoming',  $precision = 10, $scale = 4)->nullable();
            $table->decimal('sum_left',  $precision = 10, $scale = 4)->nullable();
            $table->decimal('sum_paid',  $precision = 10, $scale = 4)->nullable();
            $table->timestamp('date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomings');
    }
}
