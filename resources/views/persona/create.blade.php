@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row pt-5">
      <div class="col-10 mx-md-auto">
        <div class="card">
          <div class="card-header">Nuevo inquilino</div>

          <div class="card-body">
            <div class="col-12 mx-md-auto">
              @include('errors')
              {{ Form::open(array('route' => array('persona.save', $id))) }}
              <div class="form-row">
                <div class="form-group col-md-6">
                    {{ Form::label('nombres', 'Nombres') }}
                    {{ Form::text('nombres', null, ['class' => 'form-control', 'id' => 'nombres']) }}
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('Apellidos', 'Apellidos') }}
                    {{ Form::text('Apellidos', null, ['class' => 'form-control', 'id' => 'Apellidos']) }}
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                    {{ Form::label('cedula', 'Cédula de identidad') }}
                      <div class="form-row">
                        <div class="form-group col-3">
                          {{ Form::select('inicial', ['V' => 'V', 'E' => 'E', 'P' => 'P'], 'V', ['class' => 'form-control', 'id' => 'inicial']) }}
                        </div>
                        <div class="form-group col">
                          {{ Form::text('cedula', null, ['class' => 'form-control', 'id' => 'cedula']) }}
                          <small id="emailHelp" class="form-text text-muted">Solo números</small>
                        </div>
                      </div>
                </div>
                <div class="form-group col">
                  {{ Form::label('fecha_nacimiento', 'Fecha de nacimiento') }}
                  {{ Form::date('fecha_nacimiento', null, ['class' => 'form-control', 'id' => 'fecha_nacimiento']) }}
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                    {{ Form::label('telefono', 'Telefono fijo') }}
                    {{ Form::text('telefono', null, ['class' => 'form-control', 'id' => 'telefono']) }}
                </div>
                <div class="form-group col">
                    {{ Form::label('movil', 'Telefono móvil') }}
                    {{ Form::text('movil', null, ['class' => 'form-control', 'id' => 'movil']) }}
                </div>
              </div>

                  <div class="form-group">
                    {{Form::checkbox('representante', '1', false, ['id' => 'representante'])}}
                    {{Form::label('representante', 'Representante de la familia')}}
                  </div>
                  <div class="form-group">
                    {{Form::checkbox('arrendatario', '1', false, ['id' => 'arrendatario'])}}
                    {{Form::label('arrendatario', 'Arrendatario')}}
                  </div>
                  <div class="form-group hidden" id="alquiler">
                      {{ Form::label('inicio_alquiler', 'Fecha de inicio del alquiler') }}
                      {{ Form::date('inicio_alquiler', null, ['class' => 'form-control', 'id' => 'inicio_alquiler']) }}
                  </div>
                  {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
                  {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#menor').change(function(event) {
        if($('#menor:checkbox:checked').length > 0) {
          $('#telefono').prop('disabled', true);
          $('#movil').prop('disabled', true);
          $('#inicial').prop('disabled', true);
          $('#cedula').prop('disabled', true);
        }
        else {
          $('#telefono').attr('disabled', false);
          $('#movil').attr('disabled', false);
          $('#inicial').prop('disabled', false);
          $('#cedula').attr('disabled', false);
        }
      });
      $('#arrendatario').change(function(event) {
        if($('#arrendatario:checkbox:checked').length > 0) {
          $('#alquiler').removeClass('hidden');
        }
        else {
          $('#alquiler').addClass('hidden');
        }
      });
    });
  </script>
@endsection
