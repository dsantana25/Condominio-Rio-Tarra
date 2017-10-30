@extends('layouts.app')

@section('content')
  <div class="container px-4 py-2" id="condominio">
    <div class="row">

      <transition :duration="{ enter: 1000, leave: 1 }" name="custom-classes-transition" enter-active-class="animated fadeInLeft" leave-active-class="animated fadeInLeft">
        <template v-if="toggle.newPayment">
          <div class="col-12">{{-- Columna de nuevo pago --}}
            <div class="card my-card">
              <div class="card-header my-card-header">
                Nuevo pago
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-4 mr-2">
                    <label class="my-label">Apartamento:</label>
                    <div class="list-options row">
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == 'PB' }">
                        <input id="radio1" value="PB" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>PB</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '1' }">
                        <input id="radio1" value="1" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>1</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '2' }">
                        <input id="radio1" value="2" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>2</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '3' }">
                        <input id="radio1" value="3" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>3</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '4' }">
                        <input id="radio1" value="4" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>4</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '5' }">
                        <input id="radio1" value="5" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>5</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '6' }">
                        <input id="radio1" value="6" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>6</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.floor == '7' }">
                        <input id="radio1" value="7" v-model="payment.apartment.floor" name="radio" type="radio" class="apartment-icon-input">
                        <span>7</span>
                      </label>
                    </div>
                  </div>

                  <div class="form-group col-4">
                    <label class="my-label">Lado:</label>
                    <div class="list-options row">
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'A' }">
                        <input id="radio1" value="A" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>A</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'B' }">
                        <input id="radio1" value="B" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>B</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'C' }">
                        <input id="radio1" value="C" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>C</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'D' }">
                        <input id="radio1" value="D" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>D</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'E' }">
                        <input id="radio1" value="E" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>E</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'F' }">
                        <input id="radio1" value="F" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>F</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'G' }">
                        <input id="radio1" value="G" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>G</span>
                      </label>
                      <label class="apartment-icon col" v-bind:class="{'selected': payment.apartment.side == 'H' }">
                        <input id="radio1" value="H" v-model="payment.apartment.side" name="radio" type="radio" class="apartment-icon-input">
                        <span>H</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-auto">
                    <button v-bind:class="{'disabled': !checkApartmentSelected()}" class="btn btn-primary h-100 d-grid" type="button" name="button"><i class="material-icons align-middle">search</i>Buscar</button>
                  </div>
                </div>

                  <div class="col-3">
                    <div class="form-group">
                      <label class="my-label">Meses a pagar:</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <button @click="substractMonth" class="btn btn-light" type="button"><i class="material-icons" style="font-size:12px">remove</i></button>
                        </span>
                        <input v-model.number="payment.months.value" type="text" class="form-control text-center">
                        <span class="input-group-btn">
                          <button @click="addMonth" class="btn btn-light" type="button"><i class="material-icons" style="font-size:12px">add</i></button>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label class="my-label">Método de pago:</label>
                      <select @change="updatePaymentMethod()" class="form-control" v-model="payment.paymentType" name="">
                        <option value="1" selected>Efectivo</option>
                        <option value="2">Depósito</option>
                        <option value="3">Transferencia</option>
                        <option value="4">Cheque</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-3">
                    <template v-if="payment.paymentType == 2">
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label class="my-label">Numero de depósito:</label>
                            <input type="text" class="form-control" name="" v-model="payment.bankNumber">
                          </div>
                        </div>
                        <div class="col-3">
                          <label class="my-label">Banco de origen:</label>
                          <select v-model="payment.originBank" class="form-control" name="">
                            <option value="1">Banco Provincial</option>
                          </select>
                        </div>
                      </div>
                    </template>
                    <template v-if="payment.paymentType == 3">
                      <div class="row">
                          <div class="form-group">
                            <label class="my-label">Numero de transferencia:</label>
                            <input type="text" class="form-control" name="" v-model="payment.bankNumber">
                          </div>
                          <div class="form-group">
                            <label class="my-label">Banco de origen:</label>
                            <select v-model="payment.originBank" class="form-control" name="">
                              <option value="1">Banco Provincial</option>
                            </select>
                          </div>
                      </div>
                    </template>
                  </div>
                  <div class="col-3 mt-4">
                    <button @click="savePayment" type="button" class="btn btn-primary btn-block" name="button">Registrar pago</button>
                    <button @click="toggle.newPayment = false" type="button" class="btn btn-danger btn-block" name="button">Cancelar</button>
                  </div>
              </div>
            </div>
          </div>{{-- Fin de Columna 1 --}}
        </template>
      </transition>

      <transition :duration="{ enter: 1000, leave: 1 }" name="custom-classes-transition" enter-active-class="animated fadeInLeft" leave-active-class="animated fadeInLeft">
        <template v-if="!toggle.newPayment">
          <div class="col-12">{{-- Columna de lista de pagos --}}
            @include('errors')
            <div class="card my-card">
              <div class="card-header my-card-header">
                Pagos de condominio
              </div>
              <div class="card-body px-0">
                <div class="mb-3 px-4">
                  <ul class="nav">
                    <li class="nav-item mr-2">
                      <button class="my-button blue" @click="toggle.newPayment = true">
                        <i class="material-icons align-middle mr-3">add</i>Nuevo pago
                      </button>
                    </li>
                    <li class="nav-item">
                      <label class="mx-3">Mostrar:</label>
                      <a href="{{route('solventes')}}" class="my-button blue" type="button" name="button">Solventes</a>
                      <a href="{{url('listaMorosos')}}" class="my-button red" type="button" name="button">Morosos</a>
                      <a href="{{url('listaTodos')}}" class="my-button green" type="button" name="button">Todos</a>
                    </li>
                    <li class="nav-item ml-auto">
                      <label for="search" style="position:relative">
                        <i class="material-icons" style="position:absolute;left:85%;margin-top: 3px;">search</i>
                        <input class="my-input form-control-sm text-left" type="text" id="search" value="" placeholder="Buscar...">
                      </label>
                    </li>
                  </ul>



                </div>
                <ul class="list-group">
                  @foreach($apartments as $apartment)
                    <li class="list-group-item my-item">
                      <div class="row">
                        <div class="col">
                          <span class="list-label">Apartamento:</span>
                          <span class="list-info">{{$apartment->name}}</span>

                        </div>
                        <div class="col">
                          <span class="list-label">Ultimo pago:</span>
                          <span class="list-info">Marzo 2017</span>
                        </div>
                        <div class="col-auto">
                          <span class="list-label">Opciones:</span>
                          <a href="#" @click="getPaymentsData({{$apartment->id}})" data-toggle="modal" data-target="#exampleModal"><i class="material-icons">info</i></a>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-auto mx-auto">
                      {{$apartments->links()}}
                    </div>
                  </div>
                </div>
              </ul>
            </div>
          </div>{{-- Fin de Columna 2 --}}
        </template>
      </transition>

      <transition :duration="{ enter: 1000, leave: 1 }" name="custom-classes-transition" enter-active-class="animated fadeInLeft" leave-active-class="animated fadeInLeft">
        <template v-if="toggle.newPayment">
          <div class="col-12">{{-- Muestra de recibo --}}
            <div class="bg-light rounded p-4 my-card">
              <div class="row p-4 justify-content-around">
                <div class="col-4">
                  <img class="img-fluid" src="{{asset('images/logo.png')}}" alt="">
                </div>
                <div class="col">
                  <h4 class="title" style="text-align:right;font-weight:600 !important">Recibo de pago</h4>
                </div>
              </div>
              <div class="col-12 px-4 py-2 text-dark" style="background:#e9ecef">
                <div class="row">
                  <div class="col-12">
                    Conjunto Residencial Lago Azul - Edificio Río Tarra <br>
                    RIF: J-1111111111
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row justify-content-between">
                  <div class="col">
                    <ul class="list-group my-list">
                      <li class="list-group-item  bg-light pl-0"><strong>Apartamento:</strong> <span>7-A</span></li>
                      <li class="list-group-item bg-light pl-0"><strong>Propietario:</strong> <span>Eduardo Santana</span></li>
                    </ul>
                  </div>
                  <div class="col">
                    <h5 class="mt-3" style="text-align:right;font-weight:300 !important">Fecha: {{date('d/m/Y')}}</h5>
                  </div>
                  <hr>
                  <div class="col-12 p-0">
                    <table class="table table-sm table-responsive">
                      <thead class="thead-default">
                        <th>Nº</th>
                        <th>Descripción</th>
                        <th style="text-align:right">Importe</th>
                      </thead>
                      <tbody>
                        <template v-for="index in payment.months.value">
                          <tr>
                            <td>0000@{{index}}</td>
                            <td>Pago de condominio (Ultimo mes en deuda aqui)</td>
                            <td style="text-align:right">Bs. 9.000,00</td>
                          </tr>
                        </template>
                      </tbody>
                    </table>
                    <table class="table table-sm">
                      <tr>
                        <td colspan="4" class="table-secondary">Total</td>
                        <td colspan="1" style="text-align:right">Bs. @{{payment.months.price * payment.months.value}},00</td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-12 p-0">
                    <ul class="list-group my-list">
                      <li class="list-group-item bg-light"><strong>Método de pago:</strong> <span>@{{getPaymentType()}}</span></li>
                      <li v-if="payment.bankNumber" class="list-group-item bg-light pl-0"><strong>Número de transferencia:</strong> <span>@{{payment.bankNumber}}</span></li>
                      <li v-if="payment.originBank" class="list-group-item bg-light pl-0"><strong>Banco emisor:</strong> <span>@{{getOriginBank()}}</span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </template>
      </transition>

    </div> {{-- Fin de Row --}}
  </div>{{-- Fin de Container --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:1024px">
    <div class="modal-content" style="width:1024px">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body px-0">
        {{-- <div v-if="payments_list.length > 0">
          Si hay Datos
        </div>
        <div v-else>
          No hay Datos
        </div> --}}
        <ul class="list-group">
          <li class="list-group-item my-item">
            <div class="row">
              <div class="col">
                <span class="list-label">Mes pagado:</span>
                <span class="list-info">Enero 2017</span>
              </div>
              <div class="col">
                <span class="list-label">Método de pago:</span>
                <span class="list-info">Depósito</span>
              </div>
              <div class="col">
                <span class="list-label">Nº:</span>
                <span class="list-info">618486455</span>
              </div>
              <div class="col">
                <span class="list-label">Banco emisor:</span>
                <span class="list-info"><img src="http://opcionis.com/blog/wp-content/uploads/2016/09/bbva-logo-e1456838226318-750x300.png" height="32px" alt=""></span>
              </div>
              <div class="col">
                <span class="list-label">Fecha de pago:</span>
                <span class="list-info">08/12/2016</span>
              </div>
              <div class="col-auto">
                <span class="list-label">Opciones:</span>
                <a href="#" @click="getPaymentsData({{$apartment->id}})" data-toggle="modal" data-target="#exampleModal"><i class="material-icons">print</i></a>
              </div>
            </div>
          </li>
          <li class="list-group-item my-item">
            <div class="row">
              <div class="col">
                <span class="list-label">Mes pagado:</span>
                <span class="list-info">Febrero 2017</span>
              </div>
              <div class="col">
                <span class="list-label">Método de pago:</span>
                <span class="list-info">Efectivo</span>
              </div>
              <div class="col">
                <span class="list-label">Nº</span>
                <span class="list-info">-</span>
              </div>
              <div class="col">
                <span class="list-label">Banco emisor:</span>
                <span class="list-info">-</span>
              </div>
              <div class="col">
                <span class="list-label">Fecha de pago:</span>
                <span class="list-info">08/01/2016</span>
              </div>
              <div class="col-auto">
                <span class="list-label">Opciones:</span>
                <a href="#"><i class="material-icons">print</i></a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
