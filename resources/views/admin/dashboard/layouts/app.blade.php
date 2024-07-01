<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CafeCompass</title>

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/logo.jpg') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/logoo.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('admin.dashboard.layouts.link')
    @yield('css')
</head>
<body class="font-lato antialiased font-normal text-base leading-default bg-backgroundPrimary text-orangePrimary scrollbar-thin scrollbar-thumb-greenPrimary scrollbar-track-greenPrimary/60 scrollbar-thumb-rounded-full hover:scrollbar-thumb-greenPrimary/80 transition-all">
    @include('admin.dashboard.layouts.sidebar')

    <main class="ease-soft-in-out xl:ml-68.5 relative h-screen rounded-xl transition-all duration-200">
        @include('admin.dashboard.layouts.navbar')
        <div class="w-full px-6 py-6 mx-auto bg-backgroundPrimary">
            @yield('container')
            @include('admin.dashboard.layouts.footer')
        </div>
    </main>

    @include('admin.dashboard.layouts.script')
    @yield('js')
</body>
</html>
