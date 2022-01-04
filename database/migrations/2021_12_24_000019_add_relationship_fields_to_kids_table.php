<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKidsTable extends Migration
{
    public function up()
    {
        Schema::table('kids', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_guardian_id');
            $table->foreign('parent_guardian_id', 'parent_guardian_fk_5659351')->references('id')->on('parent_guardians');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id', 'branch_fk_5659352')->references('id')->on('kindergarden_branches');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_5659353')->references('id')->on('kindergarden_groups');
        });
    }
}
