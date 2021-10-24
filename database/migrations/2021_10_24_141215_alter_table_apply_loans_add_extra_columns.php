<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableApplyLoansAddExtraColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apply_loans', function (Blueprint $table) {
            $table->string('company_type')->nullable()->after('message');
            $table->string('business_type')->nullable()->after('message');
            $table->string('income_type')->nullable()->after('message');
            $table->string('employee_type')->nullable()->after('message');
            $table->string('type')->after('customer_id');
            $table->string('name')->after('customer_id');
            $table->string('email')->after('customer_id');
            $table->string('mobile_number')->after('customer_id');
            $table->string('company_name',45)->nullable(true)->change();
            $table->decimal('salary', 8, 2)->nullable(true)->change();
            $table->smallInteger('status')->default(0)->comment('0 - InActive, 1 - Active')->change();
            $table->unsignedbigInteger('customer_id')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apply_loans', function (Blueprint $table) {
            $table->dropColumn(['type', 'company_type', 'business_type', 'income_type', 'employee_type', 'name', 'email', 'mobile_number']);
            $table->string('company_name',45)->nullable(false)->change();
            $table->decimal('salary', 8, 2)->nullable(false)->change();
            $table->smallInteger('status')->comment('')->change();
            $table->unsignedbigInteger('customer_id')->nullable(false)->change();
        });
    }
}
