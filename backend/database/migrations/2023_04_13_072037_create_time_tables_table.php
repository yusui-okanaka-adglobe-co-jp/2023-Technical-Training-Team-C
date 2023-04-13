<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('day_of_week')->comment('曜日');
            $table->integer('period')->comment('時限');
            $table->string('subject')->comment('教科名');
            $table->string('teacher_name')->comment('教師名');
            $table->date('start_date')->comment('開始日');
            $table->date('end-date')->comment('終了日');
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
        Schema::dropIfExists('time_tables');
    }
};
