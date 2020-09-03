<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // シートセッション
            $table->biginteger('seat_session_id')->index();

            // メニューアイテム
            $table->biginteger('item_id')->index();
            // メニューアイテム日本語
            $table->biginteger('item_jp_id')->nullable()->index();

            // ステータス（=リスト登録中（注文前）, preparation=準備中, delivered=お届け後, cancel=キャンセル）
            // $table->string('order_state')->default('preparation');
            $table->enum('order_state', ['preparation', 'delivered', 'cancel'])->default('preparation');

            // 価格 （メニュー定義テーブルから転記）
            $table->integer('order_price');
            // 消費税率
            // 総桁5の小数点以下2桁
            $table->decimal('tax_rate', 5, 2);


            // 消費税額
            $table->integer('sales_tax');
            // 税込み金額
            $table->integer('tax_included_price');
            // テイクアウトかどうか
            $table->boolean('is_take_out')->default(false);

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
        Schema::dropIfExists('orders');
    }
}
