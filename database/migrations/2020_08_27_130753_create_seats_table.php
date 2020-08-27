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
            // empty(清算が終わり、席に誰も着いていない),
            // presence(席に着いて注文中),
            // waiting(出ていない料理が一つでもある),
            // all_out(料理が全て出ている),
            $table->string('seat_state')->default('empty');
            // 座席のハッシュ
            $table->string('seat_hash');

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
