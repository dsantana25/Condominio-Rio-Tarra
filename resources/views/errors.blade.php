<alert :message="Hola" v-bind:class="[this.messageType == 1 ? this.successClass : this.errorClass]"></alert>


{{-- @if($errors->any())
  <div class="alert alert-warning" role="alert">
  @foreach ($errors->all() as $message)
      <p>{{$message}}</p>
  @endforeach
  </div>
@endif --}}
