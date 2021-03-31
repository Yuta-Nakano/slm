<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table
                ->bigIncrements('id')
                ->comment('ID');
            $table
                ->string('name')
                ->comment('拠点名');
            $table
                ->string('postal_code')
                ->comment('郵便番号');
            $table
                ->string('prefecture')
                ->comment('都道府県');
            $table
                ->string('municipality')
                ->comment('市区町村');
            $table
                ->string('address')
                ->nullable()
                ->comment('番地');
            $table
                ->string('building')
                ->nullable()
                ->comment('建物・部屋番号');
            $table
                ->string('charge_name')
                ->comment('担当者名');
            $table
                ->string('phone_number')
                ->comment('電話番号');
            $table
                ->text('remarks')
                ->nullable()
                ->comment('備考欄');
            $table
                ->unsignedBigInteger('registrant_user_id')
                ->comment('登録者ID');
            $table
                ->unsignedBigInteger('updated_user_id')
                ->comment('最終登録者ID');
            $table
                ->timestamps();
            $table
                ->softDeletes()
                ->nullable();

            $table
                ->foreign('registrant_user_id')
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('branches');
    }
}
