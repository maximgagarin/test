<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('areas_id')->constrained('areas');
            $table->string('type');
            $table->string('unit');
            $table->decimal('amount',  $precision = 10, $scale = 4);
            $table->decimal('tariff',  $precision = 10, $scale = 4);
            $table->decimal('sum',  $precision = 10, $scale = 4);
            $table->timestamp('date')->nullable();
            $table->string('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
