<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKindergardenGroupsTable extends Migration
{
    public function up()
    {
        Schema::table('kindergarden_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('kindergarden_branch_id');
            $table->foreign('kindergarden_branch_id', 'kindergarden_branch_fk_5659299')->references('id')->on('kindergarden_branches');
        });
    }
}
