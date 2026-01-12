<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="icon" href="{{ $clinicInfo && $clinicInfo->logo ? asset('storage/' . $clinicInfo->logo) : asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <!-- PWA  -->
    <meta name="theme-color" content="#ffffff"/>
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Primary Meta Tags -->
    <title>Biopsy Report With ICSH Guidelines</title>
    <meta name="title" content="Biopsy Report With ICSH Guidelines">
    <meta name="description" content="Can report for bonemarrow aspirate,bonemarrrow trephine, histological report and cytological report in one place.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:title" content="Biopsy Report With ICSH Guidelines">
    <meta property="og:description" content="Can report for bonemarrow aspirate,bonemarrrow trephine, histological report and cytological report in one place.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">

    @yield('head')
</head>
<body>
@yield('content')

<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>

@if(session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{ session('status') }}'
        })
    </script>

@endif

@stack('script')
</body>
</html>
