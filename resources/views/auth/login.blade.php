@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">Iniciar sesión</div>
                <div class="card-body px-5">

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="email">Correo electrónico</label>
                          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                          @if ($errors->has('email'))
                              <div class="{{ $errors->has('email') ? ' invalid-feedback' : 'd-none' }}">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </div>
                          @endif
                        </div>

                        <div class="form-group">
                          <label for="password">Contraseña</label>
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          @if ($errors->has('password'))
                            <div class="{{ $errors->has('password') ? ' invalid-feedback' : 'd-none' }}">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                          @endif
                        </div>

                        <div class="form-group">
                          <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Recordar credenciales</span>
                          </label>
                        </div>

                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Login</button>
                          <a class="btn btn-link" href="{{ route('password.request') }}">
                              Restablecer contraseña
                          </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
