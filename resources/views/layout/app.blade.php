<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/bootstrap5/bootstrap.min.css')}}" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jQuery/sweetalert2.min.css') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jQuery/jquery.min.js') }}"></script>
    <!-- Validation library file -->
    <script src="{{ asset('/js/jQuery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jQuery/sweetalert2.min.js') }}"></script>
    <script>
        var siteUrl = "{{  url('') }}";
        //var config = {{ config('constants.GENERIC_GRID_RECORD_ADDED_SUCCESSFULLY') }};
    </script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layout.navigation')


        <!-- Page Content -->
        <main>
            @if($message = Session::get('success'))
            <div class="alert alert-success aler-dismissible fade show text-center">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                {{ $message }}
            </div>
            @endif
            @if($message = Session::get('error'))
            <div class="alert alert-danger aler-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                {{ $message }}
            </div>
            @endif
            @if($message = Session::get('warning'))
            <div class="alert alert-danger aler-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                {{ $message }}
            </div>
            @endif
            @if($message = Session::get('failure'))
            <div class="alert alert-danger aler-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                {{ $message }}
            </div>
            @endif

            @yield('content')

        </main>
    </div>
    <script src="{{ asset('js/bootstrap5/bootstrap.bundle.min.js') }}"></script>

</body>

</html>