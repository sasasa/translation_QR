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
            // 表示順(降順)
            $table->integer('item_order')->default(1);
            // 説明
            $table->text('item_desc')->nullable();
            // 画像
            $table->string('image_path');
            // 価格
            $table->integer('item_price');

            // 品切れ
            $table->boolean('is_out_of_stock')->default(false);

            // ジャンル
            $table->biginteger('genre_id')->unsigned()->index();
            // 複合インデックス
            $table->unique(['lang', 'item_key']);

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
