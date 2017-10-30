@extends('layouts.app')
@section('content')
  <div class="container" id="edit_family">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-primary text-white title">Editar familia</div>
          <div class="card-body p-0 py-4">

            <div class="row px-4 pb-5"> <!-- Buttons -->
              <a class="rounded-button" href="#"><i class="material-icons">arrow_back</i></a>
              <a @click="addMember" class="btn btn-sm btn-success mx-3" href="#"><i class="material-icons align-middle">add</i>Agregar miembro</a>
            </div>




            <form class="" action="index.html" method="put">
              <div class="form-row col-6 px-4">
                <label class="my-label" for="familyName">Nombre de la familia:</label>
                <input class="form-control" type="text" name="familyName" value="{{$family->name}}">
              </div>
              <h4 class="col-12 title my-4">Miembros de la familia</h4>
              <hr>
              @foreach ($family->owners as $owner)
                <div class="row px-4">
                  @include('_partials.editform')
                </div>
              @endforeach
              <div class="row px-4" v-for="(row, index) in members">
                @include('_partials.editform')
                <hr>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
