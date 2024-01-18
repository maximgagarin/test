<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrepaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prepays', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('sum',  $precision = 10, $scale = 4);
            $table->integer('areas_id');
            $table->timestamp('date');
            $table->string('saldo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prepays');
    }
}
