<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desk_assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desk_name');
            $table->string('employee_name');
            $table->unsignedInteger('desk_id');
            $table->foreign('desk_id')->references('id')
            ->on('desks')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desk_assigns');
    }
}
