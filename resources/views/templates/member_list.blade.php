<template v-if="isCreateEditMode()">
  <div class="card border" {{--table-id="{{$family->id}}"--}}>
    <div class="card-header text-sm-left text-xl-center bg-light border-bottom-0" style="font-size:22px">
      Miembros agregados
    </div>
    <div class="card-body bg-light px-0">
    <template v-if="members.length > 0">
      <div class="row">
        <div class="col-12">
          <ul class="list-group">
              {{-- Lista de miembros para agregar / agregados para editar --}}
              <div v-for="(member,index) in members">
                <li class="list-group-item" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);background: transparent;">
                  <div class="row" v-if="members.length > 0">
                    <div class="col">
                      <span class="my-label">Nombre:</span>
                      <span style="font-weight: 600;font-size: 18px;">@{{member.first_name}} @{{member.last_name}}</span>
                      <span style="display: block;font-size: 12px;">C.I: @{{member.identity}}</span>
                    </div>
                    <div class="col">
                      <span class="my-label">Fecha de nacimiento:</span>
                      <span style="font-weight: 600;font-size: 18px;">@{{member.birth_date}}</span>
                    </div>
                    <div class="col">
                      <span class="my-label">Teléfonos:</span>
                      <span style="display: block;font-size: 14px;font-weight: 600;">@{{member.phone}}</span>
                      <span style="display: block;font-size: 14px;font-weight: 600;">@{{member.cellphone}}</span>
                    </div>
                    <div class="col">
                      <span class="my-label">Representante de familia:</span>
                      <span v-if="member.main"><i class="material-icons">check_box</i></span>
                      <span v-else><i class="material-icons">check_box_outline_blank</i></span>
                    </div>
                    <div class="col-1">
                      <span class="my-label">Opciones:</span>
                      <a @click="deleteEditingMember(member.identity)" class="text-danger" href="#"><i class="material-icons">cancel</i></a>
                    </div>
                  </div>
                </li>
              </div>
          </ul>
        </div>
        <div class="col-12 mx-4">
          <div v-show="!toggle.edit" class="form-group mt-4">
            <label class="my-label" for="apartamento">Apartamento:</label>
            <div style="position: relative;height: 50px;">
              <i class="material-icons" style="position: absolute;margin-top: 5px;margin-left: 90px;">keyboard_arrow_down</i>
              <select v-model="apartment" type="text" name="apartment" class="custom-select mb-2 mr-sm-2 mb-sm-0" style="border-radius:0;background:transparent;border:none;border-bottom: 1px solid rgba(0, 0, 0, 0.15);width: 120px;position:absolute">
                @foreach ($apartments as $apartment)
                  <option value="{{$apartment->id}}">{{$apartment->name}}</option>
                @endforeach
              </select>
            </div>

          </div>
          <cite class="d-block" style="font-size:12px">*Se requiere un representante de familia, el cual debe ser mayor de edad</cite>
          <cite class="d-block" style="font-size:12px">*Ninguna persona asignada a una familia puede pertenecer a otra</cite>
        </div>
      </div>
    </template>

    <h5 class="text-center col" v-else>Aqui van los miembros que agregues</h5>

    <div v-if="!this.toggle.edit" class="col-12 mt-3 text-center">
      <form @submit.prevent="guardarFamilia">
        {{ csrf_field() }}
        <button :disabled="!isFamilyFormValid()" type="submit" class="btn btn-primary" name="button">Guardar familia</button>
        <button @click="goToMainPage()" class="btn btn-danger" type="button" name="button">Cancelar</button>
      </form>
    </div>
    <div v-else class="col-12 mt-3 text-center">
      <form @submit.prevent="editarFamilia">
        {{ csrf_field() }}
        <button :disabled="!isFamilyFormValid()" type="submit" class="btn btn-primary" name="button">Guardar familia</button>
        <button @click="goToMainPage()" class="btn btn-danger" type="button" name="button">Cancelar edición</button>
      </form>
    </div>
  </div>{{-- Fin de Lista --}}
</template>
