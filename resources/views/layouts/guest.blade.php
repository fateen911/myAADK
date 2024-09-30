<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MySupport') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome for eye icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { 
                background-image: url('/assets/media/auth/bg13.jpg')!important;
                background-size: cover!important; /* Scale the image to cover the entire viewport */
                background-position: center!important; /* Center the image */
                background-repeat: no-repeat!important; /* Prevent repeating the image */
                background-attachment: fixed!important; /* Optional: Fix the background image during scrolling */
                position: relative; /* Required for pseudo-element positioning */
                margin: 0; /* Ensure no margin interferes with positioning */
            }
            body::before {
                content: '';
                position: fixed; /* Change to fixed to cover the whole viewport */
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Adjust color and opacity */
                z-index: -1; /* Place it behind the content of the body */
                pointer-events: none; /* Ensures the overlay does not interfere with interactions */
            }
            [data-bs-theme="dark"] body { background-image: url('/assets/media/auth/bg9-dark.jpg')!important; }
        </style>
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md px-6 py-4 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg" style="background:white; margin-top: 20px !important; margin-bottom: 20px !important;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
