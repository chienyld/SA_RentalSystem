<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('borrow_id');
            $table->integer('user_id');
            $table->string('name');
            $table->bigInteger('depositamt');
            $table->bigInteger('qty');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->integer('time_period');
            $table->integer('status');
            $table->timestamps();
            //$table->primary('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrow');
    }
}
