<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
     {
         return [
             'nombre' => 'required|max:64',
             'cedula' => 'unique:persona|max:10',
             'fecha_nacimiento' => 'required|date',
             'telefono' => 'max:15',
         ];
     }
     public function messages() {
       return [
         'nombre.required' => 'El campo "Nombre" es requerido',
         'cedula.unique'  => 'Ya existe una persona registrada con esta cedula',
         'fecha_nacimiento.required'  => 'El campo "Fecha de nacimiento" es requerido',
         'fecha_nacimiento:date' => 'La fecha ingresada tiene un formato incorrecto',
       ];
     }
}
