<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('accounts')){
            Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('family_name',100);
            $table->string('last_name',100);
            $table->string('family_name_kana',100);
            $table->string('last_name_kana',100);
            $table->string('mail',255);
            $table->string('password',255);
            $table->integer('gender');
            $table->integer('postal_code');
            $table->string('prefecture',100);
            $table->string('address_1',100);
            $table->string('address_2',255);
            $table->integer('authority');
            $table->integer('delete_flag');
            $table->datetime('registered_time')->useCurrent()->nullable(false);
            $table->datetime('update_time')->useCurrent()->useCurrentOnUpdate()->nullable(false);
            $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
