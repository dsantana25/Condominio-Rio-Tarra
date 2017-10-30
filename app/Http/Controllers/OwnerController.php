<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonaRequest;
use App\Persona;
use App\Apartamento;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('persona.create')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonaRequest $request, $id)
    {
      $apartamento = Apartamento::find($id);

      $persona = new Persona;

      $persona->nombre = $request->get('nombre');
      $persona->fecha_nacimiento = $request->get('fecha_nacimiento');
      $persona->representante = $request->get('representante') ? $request->get('representante') : 0;
      $persona->arrendatario = $request->get('arrendatario') ? $request->get('arrendatario') : 0;

      //Si no es menor...
      if(!$request->get('menor')) {
        $persona->cedula = $request->get('inicial').$request->get('cedula');
        $persona->telefono = $request->get('telefono');
        $persona->movil = $request->get('movil');
        $persona->menor = 0;

      }
      else {
        $persona->menor = 1;
        $persona->cedula = 'MENOR';
      }

      //Si es arrendatario...
      if($request->get('arrendatario')) {
        $persona->inicio_alquiler = $request->get('inicio_alquiler');
      }

      $apartamento->personas()->save($persona);


        return back()->with('success', $request->get('nombre').' asignado al apartamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        Persona::destroy($id);
        return back()->with('success', $persona->nombre.' ha sido eliminado');
    }
}
