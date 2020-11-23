<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id', 'currency_from', 'currency_to', 'amount_from', 'amount_to', 'transaction_type'
    ];
}


