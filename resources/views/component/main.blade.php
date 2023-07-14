<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>INDI TECHNOLOGY - {{ $title }}</title>
    <link href="{{ asset('/sb-admin/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- DataTables --}}
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/datatables.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #E8F9FD;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    @include('component.navbar')
    <div id="layoutSidenav">
        @include('component.sidebar')
        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    @empty($child_title)
                        <h1 class="mt-4">{{ $title }}</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        @else
                            <h1 class="mt-4">{{ $child_title }}</h1>
                            <ol class="breadcrumb mb-4">
                                <li class="breadcrumb-item">{{ $title }}</li>
                                <li class="breadcrumb-item active">{{ $child_title }}</li>
                            @endempty
                        </ol>
                        @yield('main')
                </div>
            </main>
            @include('component.footer')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/sb-admin/js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Jquery --}}
    <script src="{{ asset('js/jquery.js') }}"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/datatables.min.js"></script>
    @yield('script')
</body>

</html>
