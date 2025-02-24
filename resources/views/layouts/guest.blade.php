<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div
            class="w-full sm:max-w-sm mt-6 px-6 py-4 bg-[#E2E8E1] shadow-md overflow-hidden sm:rounded-lg min-h-[100px]">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
