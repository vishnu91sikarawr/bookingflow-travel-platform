<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'BookingFlow') }}
    </title>

    <link rel="preconnect"
          href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="font-sans antialiased bg-gray-100">

<div class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <!-- Logo -->
        <div class="text-center mb-6">

            <a href="{{ route('home') }}"
               class="text-decoration-none">

                <h1 class="text-4xl font-bold text-blue-600">
                    🚍 BookingFlow
                </h1>

            </a>

            <p class="mt-2 text-gray-600">

                Travel Booking Platform

            </p>

            <p class="text-sm text-gray-500">

                Sign in to continue

            </p>

        </div>


        <!-- Login Card -->

        <div class="bg-white rounded-xl shadow-lg p-8">

            {{ $slot }}

        </div>


        <!-- Back -->

        <div class="text-center mt-6">

            <a href="{{ route('home') }}"
               class="text-blue-600 hover:text-blue-800">

                ← Back to Website

            </a>

        </div>

    </div>

</div>

</body>

</html>
