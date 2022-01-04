<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKindergardenBranchesTable extends Migration
{
    public function up()
    {
        Schema::create('kindergarden_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('branch_manager');
            $table->integer('phone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
