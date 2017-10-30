@extends('layouts.app')

@section('content')
  <div class="container px-4 py-2">
    <div class="row">
      <div class="col-md-3 mr-md-2 mb-4">{{-- Columna 1 --}}
        <div class="card">
          <div class="card-header">
            <h4 class="title">Menú</h4>
          </div>
          <div class="card-body p-0">
            <div class="list-group">
              <a href="#" class="border-0 list-group-item list-group-item-action">Registrar pago de condominio</a>
            </div>
          </div>
        </div>
      </div>{{-- Fin de Columna 1 --}}


      <div class="col ml-md-2 ml-md-auto">{{-- Columna 2 --}}
        @include('errors')
        <div class="card">
          <div class="card-header">
            <h4 class="title">Apartamentos</h4>
          </div>
          <div class="card-body px-0">
            <ul class="list-group my-list">
              @forelse ($apartments as $apartment)
                <li class="list-group-item">
                    <div class="row justify-content-around text-left">
                      <div class="col-auto text-left"><strong>{{$apartment->name}}</strong></div>
                      @forelse($apartment->owners as $owner)
                        @if($owner->main == true)
                          <div class="col-md-4">{{$owner->first_name}} {{$owner->last_name}}</div>
                        @endif
                      @empty
                        <div class="col-md-4 col-sm-4">Deshabitado</div>
                      @endforelse
                      <div class="col d-none d-md-block">En alquiler:
                        @if($apartment->rents()->count())
                          <div><a href="#modalAlquiler{{$apartment->id}}" role="button" data-toggle="modal">Si</a></div>
                        @else
                          <strong>No</strong>
                        @endif
                      </div>
                      <div class="col-md-4">Ultimo pago:
                        @forelse ($apartment->payments() as $payment)
                          @if($loop->last)
                            <strong>{{$payment->payment_date}}</strong>
                          @endif
                        @empty
                          <strong>-</strong>
                        @endforelse
                      </div>
                    </div>
                </li>
              @empty
                <li class="list-group-item text-center">No se han encontrado registros</li>
              @endforelse
            </ul>
            <div class="row mt-5">
              <div class="col-8 col-md-9 ml-auto">
                {{ $apartments->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>{{-- Fin de Columna 2 --}}
    </div>
  </div>

  @foreach ($apartments as $apartment)
    @include('modals.infopersona', ['id' => $apartment->id])
    @include('modals.infoalquiler', ['id' => $apartment->id])
  @endforeach
@endsection
