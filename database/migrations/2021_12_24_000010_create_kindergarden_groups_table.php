<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKindergardenGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('kindergarden_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('vacancy');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
