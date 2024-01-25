<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMovsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_movs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('payments_id')->constrained('payments');
            $table->decimal('sum',  $precision = 10, $scale = 4);
            $table->string('prepays')->nullable();
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
        Schema::dropIfExists('payment_movs');
    }
}
