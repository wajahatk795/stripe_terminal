<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentIntentIdToPaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('payment_requests', function (Blueprint $table) {
        $table->string('payment_intent_id')->nullable()->after('checkout_session_id');
    });
}

public function down()
{
    Schema::table('payment_requests', function (Blueprint $table) {
        $table->dropColumn('payment_intent_id');
    });
}

}
