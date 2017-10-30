@extends('layouts.app')
@section('content')
  <div class="container px-4 py-2">
    <div class="row" id="familia">

      <div class="col-md-3 mr-md-2 mb-sm-4">{{-- Columna 1 --}}
        <transition :duration="{ enter: 1000, leave: 1 }" name="custom-classes-transition" enter-active-class="animated fadeInLeft" leave-active-class="animated fadeInLeft">
          <template v-if="isMainMenu()">{{-- Template de Menú--}}
            <div class="card border mb-4">
              <div class="card-header text-sm-left text-xl-center  bg-light border-bottom-0" style="font-size:22px">
                Menú
              </div>
              <div class="card-body bg-light px-0">
                <div class="list-group rounded-0">
                  <a href="#" @click="toggle.create = true" class="list-group-item list-group-item-action">Nueva familia</a>
                  <a @click="toggleEdit()" :class="{active: toggle.edit }" href="#" class="list-group-item list-group-item-action">Editar familia</a>
                  <a @click="toggleDelete()" :class="{active: toggle.delete }" href="#" class="list-group-item list-group-item-action">Eliminar familia</a>
                </div>
              </div>
            </div>
          </template>
        </transition>

        <transition name="custom-classes-transition" :duration="{ enter: 1000, leave: 1 }" enter-active-class="animated fadeInLeft" leave-active-class="animated fadeInLeft">
          <template v-if="isCreateEditMode()">{{-- Template de Nuevo Miembro --}}
            <div class="card border mb-4">
              <div class="card-header text-sm-left text-xl-center  bg-light border-bottom-0" style="font-size:22px">
                Nuevo miembro
              </div>
              <div class="card-body bg-light px-0">
                <div class="px-4">
                  <form v-on:submit.prevent="submitForm">
                    @include('layouts.family-member')
                    <button :disabled="!isOwnerFormValid()" type="submit" class="btn btn-primary btn-block" style="cursor:pointer">Agregar</button>
                  </form>
                </div>
              </div>
            </div>
          </template>
        </transition>
      </div>{{-- Fin de Columna 1 --}}

      <div class="col ml-md-2 ml-md-auto">{{-- Columna 2 --}}
        <alert :message="parentMessage" :message-type="parentMessageType"></alert>

        <transition name="custom-classes-transition" :duration="{ enter: 1000, leave: 1 }" enter-active-class="animated fadeInRight" leave-active-class="animated fadeInRight">
          <template v-if="isMainMenu()">

            <div class="card border">
              <div class="card-header text-sm-left text-xl-center bg-light border-bottom-0" style="font-size:22px">
                Familias
              </div>
              <div class="card-body bg-light px-0">
                <div class="py-3">
                  @forelse ($families as $family)
                    <div id="accordion" role="tablist">
                      <transition name="custom-classes-transition" enter-active-class="animated tada" leave-active-class="animated fadeOutLeft">
                        <div class="card" v-if="!checkFamilyDeleted({{$family->id}})">
                          <div class="card-header py-3" role="tab" id="heading{{$family->id}}">
                            <div class="row justify-content-between">
                              <div class="col text-left">
                                Familia {{$family->name}}
                              </div>
                              <div class="col-3">
                                En alquiler:
                                @if($family->rents()->count())
                                  Si
                                @else
                                  <i><strong>No</strong></i>
                                @endif
                              </div>
                              <div class="col-3">
                                Habitando:
                                @if($family->active)
                                  <strong>{{$family->apartment->name}}</strong>
                                @else
                                  <i><strong>No</strong></i>
                                @endif
                              </div>
                              <div class="col-1 ml-auto">
                                <a v-show="!toggled()" data-toggle="collapse" href="#collapse{{$family->id}}" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="material-icons">arrow_drop_down</i>
                                </a>
                                <a @click="toggleEditMode({{$family->id}})" v-if="toggle.checkEdit" href="#"><i class="material-icons">mode_edit</i></a>
                                <a @click="eliminarFamilia({{$family->id}})" v-if="toggle.checkDelete" href="#" class="text-danger"><i class="material-icons">delete</i></a>
                              </div>
                            </div>
                          </div>

                          <div id="collapse{{$family->id}}" class="collapse hide" role="tabpanel" aria-labelledby="heading{{$family->id}}" data-parent="#accordion">
                            <div class="card-body">
                              Miembros:
                              <table class="table">
                                <thead>
                                  <th>Nombre y Apellido</th>
                                  <th>Cédula</th>
                                  <th>Edad</th>
                                </thead>
                                <tbody>
                                  @foreach($family->owners as $owner)
                                    <tr>
                                      <td>{{$owner->first_name}} {{$owner->last_name}}</td>
                                      <td>{{$owner->identity}}</td>
                                      <td>{{$owner->age($owner->birth_date)}} años</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </transition>
                    </div>
                  @empty
                    <div class="text-center py-3">
                      No hay apartamentos habitados
                    </div>
                  @endforelse
                </div>
                <div class="row">
                  <div class="col-5 mx-auto">
                    {{ $families->links() }}
                  </div>
                </div>
              </div>
            </div>
          </template>
        </transition>

        <transition name="custom-classes-transition" :duration="{ enter: 1000, leave: 1 }" enter-active-class="animated fadeInRight" leave-active-class="animated fadeInRight">
          @include('templates.member_list')
        </transition>
      </div>

    </div>
  </div>
@endsection
