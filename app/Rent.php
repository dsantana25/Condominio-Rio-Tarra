<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = ['start_date', 'end_date'];

    public function apartment() {
      return $this->belongsTo('App\Apartment', 'id_apartment');
    }
    public function family() {
      return $this->belongsTo('App\Family', 'id_family');
    }
}
