<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  protected $fillable = ['name'];

  public function families() {
    return $this->hasMany('App\Family', 'id_apartment');
  }
  public function owners() {
    return $this->hasManyThrough('App\Owner', 'App\Family', 'id_apartment', 'id_family');
  }
  public function rents() {
    return $this->hasMany('App\Rent', 'id_apartment');
  }
  public function payments() {
    return $this->hasMany('App\Payment', 'id_apartment');
  }
}
