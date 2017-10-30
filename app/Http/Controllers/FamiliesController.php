<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use App\Owner;
use App\Apartment;
use App\Http\Requests\StoreFamilyRequest;

class FamiliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $families = Family::paginate(8);
      $apartments = Apartment::doesntHave('families')->get();

      return view('familia.read')->withFamilies($families)->withApartments($apartments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $apartments = Apartment::all();
      $index = Family::all()->count();
        return view('familia.create')->withApartments($apartments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyRequest $request)
    {
      try {
        $oldDate = explode('/',$request->members[0]["birth_date"]);
        $newDate = $oldDate[2].'-'.$oldDate[1].'-'.$oldDate[0];
        $family = new Family();
        $family->name = $request->members[0]["last_name"];
        $family->id_apartment = $request->apartment;
        $family->active = 1;
        $family->save();
        foreach ($request->members as $member) {
          $owner = new Owner();

          $owner->first_name = $member["first_name"];
          $owner->last_name = $member["last_name"];
          $owner->birth_date = $newDate;
          if(isset($member["identity"])) {
            $owner->identity = $member["identity"];
          }
          if(isset($member["phone"])) {
            $owner->phone = $member["phone"];
          }
          if(isset($member["cellphone"])) {
            $owner->cellphone = $member["cellphone"];
          }
          if(isset($member["main"])) {
            $owner->main = $member["main"];
          }
          if(isset($member["email"])) {
            $owner->email = $member["email"];
          }
          $family->owners()->save($owner);
        }
        return response()->json(['success' => true]);
      }
      catch (Exception $e) {
        return response()->json(['error' => 'Mierda']);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      try {
        $family = Family::findOrFail($request->family_id);

        //Le cambio el nombre de ser necesario
        //$family->fill(['name' => $request->members[0]['last_name']]);

        $oldDate = explode('/',$request->members[0]["birth_date"]);
        $newDate = $oldDate[2].'-'.$oldDate[1].'-'.$oldDate[0];

        //Elimino sus miembros
        foreach ($family->owners() as $owner) {
          $owner->delete();
        }

        //y agrego los miembros nuevos
        foreach ($request->members as $member) {
          $newOwner = Owner::firstOrNew(
            ['first_name' => $member['first_name'],
             'last_name' => $member['last_name'],
             'identity' => $member['identity'],
             'phone' => $member['phone'],
             'cellphone' => $member['cellphone'],
             'email' => $member['email'],
             'birth_date' => $newDate,
             'main' => $member['main']]
           );
           $family->owners()->save($newOwner);
        }
        return response()->json(['success' => 'Mensaje de Exito']);
      }
      catch (Exception $e) {
        return response()->json(['error' => 'Error!!!']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request->id;
    }
    public function getMembers(Request $request) {
      $family = Family::findOrFail($request->id);
      return response()->json(['success' => true, 'owners' => $family->owners, 'apartment' => $family->apartment->id]);
    }
    public function show()  {
      //...
    }
}
