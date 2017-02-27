<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id');
            $table->string('firstName', 20);
            $table->string('lastName', 100);
            $table->date('dob');
            $table->enum('gender',['Nam','Nữ']);
            $table->string('school')->nullable();
            $table->string('class',10)->nullable();
            $table->string('email')->nullable();
            $table->string('phone',11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
