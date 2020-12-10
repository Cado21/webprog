<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('price', 10, 2);
            $table->string('name');
            $table->longText('image')->nullable();
            $table->text('description');

            $table->foreignId('product_id')->nullable();
            $table->foreignId('type_id')->nullable();
            $table->string('type_name');

            $table->timestamps();

            $table->foreignId('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
}
