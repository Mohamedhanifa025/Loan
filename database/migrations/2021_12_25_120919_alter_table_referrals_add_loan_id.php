<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableReferralsAddLoanId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable(true)->change();
            $table->unsignedBigInteger('referred_id')->nullable(true)->change();
            $table->unsignedBigInteger('apply_loan_id')->nullable()->after('id');
            $table->foreign('apply_loan_id')->references('id')->on('apply_loans')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign('referrals_apply_loan_id_foreign');
            $table->dropColumn('apply_loan_id');
            $table->unsignedBigInteger('customer_id')->nullable(false)->change();
            $table->unsignedBigInteger('referred_id')->nullable(false)->change();
        });
    }
}
