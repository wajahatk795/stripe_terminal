<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $fillable = [
        'client_name',
        'client_email',
        'service_desc',
        'amount_cents',
        'checkout_url',
        'payment_intent_id', // ✅ add this
        'status',
        'checkout_session_id',
    ];
}
