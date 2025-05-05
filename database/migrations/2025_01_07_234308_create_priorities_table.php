<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePrioritiesTable extends Migration
{
    public function up()
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        // Adăugăm datele implicite pentru priorități
        DB::table('priorities')->insert([
            ['name' => 'Urgent', 'description' => 'Tasks that need to be done immediately'],
            ['name' => 'Prioritate Mare', 'description' => 'High-priority tasks'],
            ['name' => 'Prioritate Medie', 'description' => 'Medium-priority tasks'],
            ['name' => 'Prioritate Scazuta', 'description' => 'Low-priority tasks'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('priorities');
    }
}
