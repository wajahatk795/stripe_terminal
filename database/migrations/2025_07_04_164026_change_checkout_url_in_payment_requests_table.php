<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('payment_requests', function (Blueprint $table) {
            $table->text('checkout_url')->change();
        });
    }

    public function down()
    {
        Schema::table('payment_requests', function (Blueprint $table) {
            $table->string('checkout_url')->change();
        });
    }
};
