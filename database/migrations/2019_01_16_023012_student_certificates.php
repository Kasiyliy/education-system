<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentCertificates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_certificates', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('IdNo');

            $table->integer('subject_id')->unsigned()->nullable();
            $table->foreign('subject_id')
                ->references('id')
                ->on('subject');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('set null');

            $table->integer('teacher_id')->unsigned()->nullable();
            $table->foreign('teacher_id')
                ->references('id')
                ->on('users')->onDelete('set null');

            $table->timestamps();
            $table->date('goden_do');
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
        Schema::drop('student_certificates');
    }
}
