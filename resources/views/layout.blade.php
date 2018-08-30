<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
      <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>Physicist's den</title>

            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">

            <script>
                  window.App = {!! json_encode([
                        'csrfToken' => csrf_token(),
                        'signedIn' => Auth::check(),
                        'user' => Auth::user()
                  ]) !!};
            </script>


      </head>

<body>
     <div id="app">

            @include('partials.nav')
                  @yield('content')
            @include('partials.footer')

            <flash class="alert-flash" error ="{{session('error')}}" message="{{session('message')}}"></flash>
      </div>

      <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
