<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dealer_id')->unsigned();
            $table->string('name');
            $table->string('tax_number')->unique();
            $table->string('tax_office')->nullable();
            $table->string('email')->nullable();
            $table->string('gsm')->nullable();
            $table->string('website')->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('province_id')->unsigned()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->date('foundation_date')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token')->nullable();
            $table->rememberToken();
            $table->bigInteger('transaction_status_id')->unsigned()->default(1);
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
        Schema::dropIfExists('customers');
    }
}
