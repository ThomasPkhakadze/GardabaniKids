<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentGuardiansTable extends Migration
{
    public function up()
    {
        Schema::create('parent_guardians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->integer('id_number')->unique();
            $table->string('guardian_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
