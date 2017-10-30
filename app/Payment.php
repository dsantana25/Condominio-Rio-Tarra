<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment_date', 'payment_method', 'paid_month'];

    public function apartment() {
      return $this->belongsTo('App\Apartment', 'id_apartment');
    }
}
