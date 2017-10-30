<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
  protected $fillable = ['name'];

  public function owners() {
    return $this->hasMany('App\Owner', 'id_family');
  }
  public function rents() {
    return $this->hasMany('App\Rent', 'id_family');
  }
  public function apartment() {
    return $this->belongsTo('App\Apartment', 'id_apartment');
  }

}
