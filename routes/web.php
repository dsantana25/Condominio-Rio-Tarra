<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/familia', function() {
  echo date('D/M/Y');
});
Route::get('/', function(){
  return view('check');
});

Route::group(['middleware' => 'auth'], function () {

  Route::resource('apartamento', 'ApartmentController');
  Route::resource('familia', 'FamiliesController');
  Route::get('condominio/solventes', 'AccountingController@listaSolventes')->name('solventes');
  Route::post('storeOlderDebtor', 'AccountingController@storeOlderDebtor');
  Route::get('settings', 'AccountingController@settings')->name('condominio.settings');
  Route::resource('condominio', 'AccountingController');
  Route::resource('persona', 'OwnerController');

  Route::get('persona/create/{id}','OwnerController@create')->name('persona.add');
  Route::get('getPaymentsData', 'AccountingController@getPaymentsData');

  Route::get('/checkIfOwnerExists/{identity}', function($identity) {
    $owners = App\Owner::find($identity);

    if(!$owners) {
      return response()->json(['notFoundError' => true]);
    }
  });


  Route::get('getApartmentData/{data}', function($data) {
    $apartment = App\Apartment::find($data);

    if(!$apartment) {
      return response()->json(['databaseError' => true]);
    }

    foreach ($apartment->owners as $owner) {
      if($owner->main == 1)
        $ownerData = $owner;
    }

    try {
      $lastPayment = $apartment->payments()->firstOrFail();
      $lastMonthPaid = $lastPayment->paid_month;
    }
    catch (Exception $e) {
      $lastMonthPaid = 0;
    }

    return response()->json(['name' => $ownerData->first_name.' '.$ownerData->last_name, 'identity' => $ownerData->identity, 'lastMonthPaid' => $lastMonthPaid ]);
  });







  Route::get('getApartments', function() {
    return response()->json(['apartments' => App\Apartment::all()]);
  });
  Route::get('getOlderDebtor', function() {
    $config = App\Config::first();
    // echo $config->older_debtor;
    return response()->json(['older_debtor' => $config->older_debtor]);
  });

  Route::post('guardarFamilia', 'FamiliesController@store');
  Route::post('editarFamilia', 'FamiliesController@update');
  Route::post('deshabitar', 'FamiliesController@destroy');
  Route::post('persona/store/{id}','OwnerController@store')->name('persona.save');


  Route::post('getFamilyMembers', 'FamiliesController@getMembers');



});

Auth::routes();
