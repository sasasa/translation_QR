<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_sessions', function (Blueprint $table) {
            $table->id();
            // 座席ID
            $table->biginteger('seat_id')->unsigned()->index();
            // セッションキー
            $table->string('session_key');
            // ステータス（in_use 利用中, end_of_use 利用終了）
            // $table->string('session_state');
            $table->enum('session_state', ['in_use', 'end_of_use'])->default('in_use');
            
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
        Schema::dropIfExists('seat_sessions');
    }
}
