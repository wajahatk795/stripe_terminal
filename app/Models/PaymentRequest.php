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
        'status',
    ];
}
