<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id');
            $table->string('receiver');
            $table->string('subject');
            $table->smallInteger('class');
            //Hẹn lịch kiểm tra và Nhắc lịch
            $table->datetime('appointment')->nullable();
            $table->boolean('showUp');
            $table->boolean('testInform');
            //Chuyển bài cho giáo viên + Thông báo kết quả
            $table->string('teacher');
            $table->date('receiveTime')->nullable();
            $table->string('result')->nullable;
            $table->boolean('resultInform');
            $table->enum('decision',['Xếp lớp','Chờ mở lớp','Cân nhắc thêm'])->nullable();
            $table->integer('officalClass')->nullable();

            //Nhắc lịch học
            $table->datetime('firstDay');
            $table->boolean('inform');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolls');
    }
}
