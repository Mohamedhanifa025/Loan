<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableContactsChangeCustomerIdNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('name')->nullable(true)->after('id');
            $table->unsignedBigInteger('customer_id')->nullable(true)->change();
            $table->unsignedInteger('user_id')->nullable(true)->after('customer_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign('');
            $table->dropColumn(['name', 'user_id']);
            $table->unsignedBigInteger('customer_id')->nullable(false)->change();
        });
    }
}
