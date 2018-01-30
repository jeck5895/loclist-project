<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SRI-Locatorslist</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="/images/icon.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css"/>
</head>
<body>
    <div id="app" class="wrapper">
        @include('layouts.navbar')

        @yield('content')
    </div>

    <!-- Scripts -->
     <script type="text/x-template" id="select2-template">
        <select multiple>
            <slot></slot>
        </select>
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzuR3C9fwpMSVr51bQv-Y-zEVvVjFoytc&libraries=places"></script>
    <!-- <script type="text/javascript" src="/plugins/offline-0.7.13/offline.min.js"></script> -->
</body>
</html>
