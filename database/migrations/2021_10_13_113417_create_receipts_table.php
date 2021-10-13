<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('creator_type');
            $table->bigInteger('creator_id')->unsigned();
            $table->string('relation_type');
            $table->bigInteger('relation_id')->unsigned();
            $table->bigInteger('credit_id')->unsigned();
            $table->double('price')->unsigned();
            $table->bigInteger('receipt_status_id')->unsigned();
            $table->dateTime('payment_datetime')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('receipts');
    }
}
