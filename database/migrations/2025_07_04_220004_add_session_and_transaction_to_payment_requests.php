<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessionAndTransactionToPaymentRequests extends Migration
{
    public function up()
    {
        Schema::table('payment_requests', function (Blueprint $table) {
            $table->string('checkout_session_id')->nullable()->after('checkout_url');
            $table->string('transaction_id')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('payment_requests', function (Blueprint $table) {
            $table->dropColumn(['checkout_session_id', 'transaction_id']);
        });
    }
}
