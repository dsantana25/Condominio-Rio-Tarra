@if($successMessage)
    <p class="bg-success rounded p-3 text-light mb-3">
      <button @click="alert.successDisplay = false" type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      {{$successMessage}}
    </p>
@elseif($errorMessage)
    <p class="bg-danger rounded p-3 text-light mb-3">
      <button @click="alert.errorDisplay = false" type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      {{$errorMessage}}
    </p>
@endif


@if($errors->any())
  <div class="alert alert-warning" role="alert">
  @foreach ($errors->all() as $message)
      <p>{{$message}}</p>
  @endforeach
  </div>
@endif
