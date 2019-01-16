<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('Goden');
            $table->text('inspired_by');
            $table->text('on_behalf_and_for');
            $table->integer('subject_id')->unsigned()->nullable();
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
        Schema::drop('certificates');
    }
}
