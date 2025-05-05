<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaskIdToPrioritiesTable extends Migration
{
    public function up()
    {
        Schema::table('priorities', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable();  // Adăugăm task_id
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');  // Definim foreign key-ul
        });
    }

    public function down()
    {
        Schema::table('priorities', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropColumn('task_id');
        });
    }
}