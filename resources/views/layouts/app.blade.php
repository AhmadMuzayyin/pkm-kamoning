<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Styling -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/b-html5-3.2.2/b-print-3.2.2/cr-2.0.4/datatables.min.css"
        rel="stylesheet">

    <style>
        .btn-primary:active {
            background-color: #6f9e8f !important;
        }

        .btn-primary {
            background-color: #8ac4b0;
            color: #fff;
            border: none;
            padding: 0.4rem 0.4rem;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #6f9e8f;
        }

        .bg-primary {
            background-color: #8ac4b0 !important;
            border: #6f9e8f !important;
            color: white !important;
        }

        .bg-main {
            background-color: #E2E8E1 !important;
            border: #E2E8E1 !important;
            color: white !important;
        }

        .dt-orderable-asc.dt-orderable-desc {
            background-color: #E2E8E1 !important;
        }

        td {
            background-color: #E2E8E1 !important;
            border: #E2E8E1 !important;
        }

        .page-link {
            background-color: #E2E8E1 !important;
            border: #6f9e8f !important;
            color: black !important;
        }
    </style>
</head>

<body class="font-family-sans-serif">
    <div class="min-vh-100" style="background-color: #E2E8E1">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="shadow-sm" style="background-color: #E2E8E1">
                <div class="container py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    {{-- scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/b-html5-3.2.2/b-print-3.2.2/cr-2.0.4/datatables.min.js">
    </script>
    @stack('scripts')
</body>

</html>
