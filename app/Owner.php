<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable =
     ['first_name',
      'last_name',
      'identity',
      'phone',
      'cellphone',
      'email',
      'birth_date',
      'main'];

    public function family() {
      return $this->belongsTo('App\Family', 'id_family');
    }

    public function age($birth_date) {

      $now_year = date('Y');
      $now_month = date('m');
      $now_day = date('d');

      $parts = explode('-', $birth_date);
      $birth_year = $parts[0];
      $birth_month = $parts[1];
      $birth_day = $parts[2];

      if($birth_month > $now_month) {
        $age = ($now_year-$birth_year)-1;
      }
      else if($birth_month == $now_month) {
        if($birth_day > $now_day) {
          $age = ($now_year-$birth_year)-1;
        }
        else {
          $age = $now_year-$birth_year;
        }
      }
      else {
        $age = $now_year-$birth_year;
      }
      return $age;
    }
}
