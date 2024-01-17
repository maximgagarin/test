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
            $table->string('number');
            $table->string('address');
            $table->string('telephone');
            $table->string('name');
            $table->decimal('square', $precision = 5, $scale = 2);
            $table->decimal('balance', $precision = 10, $scale = 4);
            $table->string('comment', 500);
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
