<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table
                ->bigIncrements('id')
                ->comment('ID');
            $table
                ->unsignedBigInteger('branch_id')
                ->comment('拠点ID');
            $table
                ->unsignedBigInteger('product_id')
                ->comment('商品ID');
            $table
                ->unsignedBigInteger('in')
                ->nullable()
                ->default(0)
                ->comment('入庫数');
            $table
                ->unsignedBigInteger('out')
                ->nullable()
                ->default(0)
                ->comment('出庫数');
            $table
                ->unsignedBigInteger('total')
                ->nullable()
                ->default(0)
                ->comment('在庫数');
            $table
                ->unsignedBigInteger('updated_user_id')
                ->comment('変動実行者ID');
            $table
                ->timestamp('update_at')
                ->useCurrent()
                ->comment('変動日時');

            $table
                ->foreign('branch_id')
                ->references('id')
                ->on('branches');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products');
            $table
                ->foreign('updated_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stocks');
    }
}
