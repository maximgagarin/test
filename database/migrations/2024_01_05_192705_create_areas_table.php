<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('number')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('name')->nullable();
            $table->decimal('square', $precision = 6, $scale = 2)->nullable();
            $table->decimal('balance', $precision = 10, $scale = 4);
            $table->string('comment', 500)->nullable();
            $table->integer('area_status')->nullable();
//            $table->integer('owner')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
