<div class="row">
  <div class="col-12 text-center">
    <label class="no-photo-link align-middle" style="cursor:pointer;">
      <i class="material-icons no-photo-icon">person</i>
      <input autocomplete="off" class="custom-control-input" type="file" name="photo" value="">
    </label>
  </div>
  <div class="col">
    <div class="row">
      {{-- Nombres --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('first_name') }">
        <label class="my-label" for="first_name">Nombres:</label>
        <p style="position:relative">
          <input v-validate="'required|alpha|min:3'" data-vv-as="Nombres"  autocomplete="off" v-model="addingMember.first_name.value" class="form-control my-input" type="text" name="first_name">
          <i v-if="errors.has('first_name')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('first_name')">@{{errors.first('first_name')}}</p>
      </div>
      {{-- Apellidos --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('last_name') }">
        <label class="my-label" for="last_name">Apellidos:</label>
        <p style="position:relative">
          <input v-validate="'required|alpha|min:3'" data-vv-as="Apellidos" autocomplete="off" v-model="addingMember.last_name.value" class="form-control my-input" type="text" name="last_name">
          <i v-if="errors.has('last_name')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('last_name')">@{{errors.first('last_name')}}</p>
      </div>
      {{-- Fecha de Nacimiento --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('birth_date') }">
        <label class="my-label" for="birth_date">Fecha de nacimiento:</label>
        <p style="position:relative">
          <input v-validate="'required|date_format:DD/MM/YYYY|date_between:01/01/1800,{{date('d/m/Y')}}'" data-vv-as="Fecha de nacimiento" @keyup="isMemberAdult()" autocomplete="off" v-model="addingMember.birth_date.value" class="form-control my-input" type="text" name="birth_date" placeholder="DD/MM/YYYY">
          <i v-if="errors.has('birth_date')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('birth_date')">@{{errors.first('birth_date')}}</p>
      </div>
      {{-- Cédula de identidad --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('identity') }">
        <label class="my-label" for="identity">Cédula de identidad:</label>
        <p style="position:relative">
          <input v-validate="'numeric|min:5'" data-vv-as="Cédula de identidad" @key="ownerexists()" autocomplete="off" v-model="addingMember.identity.value" class="form-control my-input" type="text" name="identity">
          <i v-if="errors.has('identity')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('identity')">@{{errors.first('identity')}}</p>
      </div>
      {{-- Teléfono --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('phone') }">
        <label class="my-label" for="phone">Telefono fijo:</label>
        <p style="position:relative">
          <input v-validate="'numeric|min:11'" data-vv-as="Telefono fijo" autocomplete="off" v-model="addingMember.phone.value" class="form-control my-input" type="text" name="phone">
          <i v-if="errors.has('phone')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('phone')">@{{errors.first('phone')}}</p>
      </div>
      {{-- Telefono móvil --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('cellphone') }">
        <label class="my-label" for="cellphone">Telefono móvil:</label>
        <p style="position:relative">
          <input v-validate="'numeric|min:11'" data-vv-as="Telefono móvil" autocomplete="off" v-model="addingMember.cellphone.value" class="form-control my-input" type="text" name="cellphone">
          <i v-if="errors.has('cellphone')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('cellphone')">@{{errors.first('cellphone')}}</p>
      </div>
      {{-- Correo electronico --}}
      <div :class="{'form-group col-12': true, 'form-danger': errors.has('email') }">
        <label class="my-label" for="email">Correo electrónico:</label>
        <p style="position:relative">
          <input v-validate="'email|min:8'" data-vv-as="Correo electrónico" autocomplete="off" v-model="addingMember.email.value" class="form-control my-input" type="email" name="email">
          <i v-if="errors.has('email')" class="material-icons" style="position: absolute;top: 10%;right:0;color: red;">remove_circle</i>
        </p>
        <p class="text-danger" v-if="errors.has('email')">@{{errors.first('email')}}</p>
      </div>
      <div v-show="!isRepr()" class="form-check col-12">
        <label class="form-check-label" style="font-size:14px">
          <input class="form-check-input" :disabled="!addingMember.isAdult" v-model="addingMember.isFamilyMain" type="checkbox" name="main">
          Representante de la familia (*)
        </label>
      </div>
    </div>
  </div>
</div>
