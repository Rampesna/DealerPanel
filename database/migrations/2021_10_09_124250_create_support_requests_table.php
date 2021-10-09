<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->string('creator_type');
            $table->bigInteger('creator_id')->unsigned();
            $table->string('relation_type');
            $table->bigInteger('relation_id')->unsigned();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('priority_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
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
        Schema::dropIfExists('support_requests');
    }
}
