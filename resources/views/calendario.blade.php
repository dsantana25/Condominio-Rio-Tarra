@extends('layouts.app')

@section('content')
  <div class="container" id="settings">
    <div class="row">
      <div class="col-12">
        @include('errors')
        <div class="card my-card">
          <div class="card-header my-card-header">
            Configuración
          </div>
          <div class="card-body">
            <div class="form-inline">
              <label class="mr-2" for="last_year">Ultimo año de deudas:</label>
              <input v-model="config.older_debtor.value" class="form-control mr-2" type="text" name="older_debtor">
              <button @click="storeOlderDebtor()" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
