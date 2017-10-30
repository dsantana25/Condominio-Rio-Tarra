<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <style media="screen">
    html, body,.container-fluid {
      height: 100%;
    }
    .row {
      background: url(http://www.powerpointhintergrund.com/uploads/formal-background-for-ppt-3.jpg);
    }
    img {
      width: 80%;
      position: absolute;
      top: -50px;
      left: 9%
    }
    h4 {
      font-family: 'Roboto Condensed';
      font-size: 30px;
    }
    /* do not group these rules */
    *::-webkit-input-placeholder {
        color: white !important;
        font-weight: 100;
    }
    *:-moz-placeholder {
        /* FF 4-18 */
        color: white !important;
    }
    *::-moz-placeholder {
        /* FF 19+ */
        color: white !important;
    }
    *:-ms-input-placeholder {
        /* IE 10+ */
        color: white !important;
    }
  </style>
</head>
<body>
  <div class="container-fluid">

    <div class="row h-100">
      <div class="col-lg-4 col-md-12 m-auto">
        <div class="card my-card" style="background: rgba(0,0,0,0.5);">
          <div class="card-body py-5">
            <img src="{{asset('images/logow.png')}}" alt="">
            <h4 class="text-center text-light mt-4">Consultar deuda</h4>
            <div class="my-4">
              <div class="form-group">
                <input class="form-control" type="text" name="" value="" placeholder="Cédula de identidad" style="    background: rgba(255,255,255,0.5);">
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-block search-button" type="button" name="button">Buscar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>










  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
