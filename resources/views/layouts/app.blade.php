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
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- DataTables Bootstrap 5 CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Custom Styles -->
        <style>
            .card {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            }
            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
            }
            .btn {
                transition: all 0.2s ease-in-out;
            }
            .table th {
                border-top: none;
                font-weight: 600;
                background-color: #f8f9fa;
            }
            .dataTables_wrapper .dataTables_length select,
            .dataTables_wrapper .dataTables_filter input {
                border: 1px solid #e3e6f0;
                border-radius: 0.6rem;
                padding: 0.6rem 1rem;
                background-color: #ffffff;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
                font-size: 0.9rem;
                font-weight: 400;
                color: #495057;
                min-width: 250px;
                height: 42px;
            }
            .dataTables_wrapper .dataTables_filter input:focus {
                border: 1px solid #4e73df;
                box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.1), 0 2px 6px rgba(0, 0, 0, 0.08);
                outline: none;
                background-color: #fdfdfe;
            }
            .dataTables_wrapper .dataTables_filter input:hover {
                border-color: #d1d3e2;
                box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            }
            .dataTables_wrapper .dataTables_filter input::placeholder {
                color: #858796;
                font-style: italic;
            }
            .dataTables_wrapper .dataTables_filter {
                text-align: left !important;
                float: left !important;
            }
            .dataTables_wrapper .dataTables_length {
                text-align: right !important;
                float: right !important;
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                border-radius: 0.375rem;
                margin: 0 2px;
            }
            .toast-container {
                z-index: 1055;
            }
            .modal-backdrop {
                backdrop-filter: blur(2px);
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
