<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            // 言語
            $table->string('lang')->index();
            // 名前
            $table->string('item_name');
            // 同一なものと確かめるためのキー
            $table->string('item_key');
            // 説明
            $table->text('item_desc')->nullable();
            // 画像
            $table->string('image_path');
            // 価格
            $table->integer('item_price');
            // ジャンル
            $table->biginteger('genre_id')->index();

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
        Schema::dropIfExists('items');
    }
}
