<div class="form-group col">
  <label class="my-label" for="familyName">Nombres:</label>
  <input class="form-control" type="text" v-model="members.name" name="first_name[]" value="{{$owner->first_name}}">
</div>
<div class="form-group col">
  <label class="my-label" for="familyName">Apellidos:</label>
  <input class="form-control" type="text" name="last_name[]" value="{{$owner->last_name}}">
</div>
<div class="form-group col">
  <label class="my-label" for="familyName">Fecha de nacimiento:</label>
  <input class="form-control" type="date" name="birth_date[]" value="{{$owner->birth_date}}">
</div>
<div class="form-group col">
  <label class="my-label" for="familyName">Cédula de identidad:</label>
  <input class="form-control" type="text" name="birth_date[]" value="{{$owner->identity}}">
</div>
<div class="form-group col">
  <label class="my-label" for="main">Representante:</label>
  <label class="custom-control custom-radio d-block">
    <input name="main[]" type="radio" class="custom-control-input" value="{{$owner->main}}">
    <span class="custom-control-indicator"></span>
  </label>
</div>
<div class="col-1" style="line-height:4">
  <a class="text-danger align-middle" href="#" aria-label="Eliminar miembro"><i class="material-icons align-middle">cancel</i></a>
</div>
