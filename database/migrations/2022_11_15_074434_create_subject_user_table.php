<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subject_id');
            $table->integer('score');
            $table->foreign('user_id', 'subject_user_user_fk')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('group_id', 'subject_user_subject_fk')->on('subjects')->references('id')->onDelete('cascade');
            $table->uniqe(['user_id','subject_id'], 'user_id_subject_id_uniqe');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_user');
    }
};
