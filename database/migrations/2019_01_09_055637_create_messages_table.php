<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subject');
            $table->integer('sender_user_id')->unsigned();
            $table->foreign('sender_user_id')
                ->references('id')
                ->on('users');
            $table->integer('acceptor_user_id')->unsigned();
            $table->foreign('acceptor_user_id')
                ->references('id')
                ->on('users');
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
        Schema::drop('messages');
    }
}
