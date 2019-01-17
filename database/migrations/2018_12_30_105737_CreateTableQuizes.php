<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 191);
            $table->text('description');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subject');
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
        Schema::drop('quizes');
    }
}
