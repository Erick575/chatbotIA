<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [ 'user_id', 'currency_id', 'amount' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id' , 'user_id');
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
    

}



