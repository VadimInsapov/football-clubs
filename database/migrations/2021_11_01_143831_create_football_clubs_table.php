<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootballClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_game');
            $table->string('stadium');
            $table->timestamps();
        });
        Schema::create('club_heads', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
        });
        Schema::create('football_clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название клуба');
            $table->string('country')->comment('Страна в которой клуб играет');
            $table->string('logo')->nullable();
            $table->date('date_created')->nullable()->comment('Дата основания клуба');
            $table->foreignId('club_head_id')->constrained('club_heads')->nullable()->comment('Глава клуба');
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
        Schema::dropIfExists('football_clubs');
    }
}
