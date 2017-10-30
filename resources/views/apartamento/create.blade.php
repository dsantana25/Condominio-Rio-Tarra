@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Nuevo apartamento</div>

          <div class="panel-body">
            <div class="col-md-8 col-md-offset-2">
              @include('errors')
              {{ Form::open(array('route' => 'apartamento.store')) }}
                  <div class="form-group">
                      {{ Form::label('numero', 'Apartamento') }}
                      {{ Form::text('numero', null, ['class' => 'form-control']) }}
                  </div>
                  {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
                  {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
