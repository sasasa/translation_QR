<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            // 座席名
            $table->string('seat_name');
            // 座席名の状態
            // $table->string('seat_state')->default('empty');
            $table->enum('seat_state', ['empty', 'presence', 'payment'])->default('empty');

            // 座席のハッシュ
            $table->string('seat_hash');

            // 席数
            $table->integer('how_many')->nullable();

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
        Schema::dropIfExists('seats');
    }
}
