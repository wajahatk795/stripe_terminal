<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email')->nullable();
            $table->string('service_desc');
            $table->integer('amount_cents'); // store amount in cents
            $table->string('checkout_url');
            $table->string('status')->default('pending'); // could later be 'paid' or 'cancelled'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_requests');
    }
};
