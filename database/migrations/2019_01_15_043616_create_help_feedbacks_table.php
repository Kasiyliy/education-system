<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('surname');
            $table->text('email');
            $table->text('message');
            $table->boolean('feedback')->default(1);
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
        Schema::drop('help_feedbacks');
    }
}
