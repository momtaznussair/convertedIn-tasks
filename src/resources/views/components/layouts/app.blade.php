<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="netro">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')

        <title>{{ $title ?? 'ConvertedIn Tasks' }}</title>
    </head>
    <body>

        @include('components.layouts.nav')

        {{ $slot }}

        @if (session('success'))
        <div class="toast toast-bottom toast-end">
            <div class="alert alert-success">
              <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif
    </body>
</html>
