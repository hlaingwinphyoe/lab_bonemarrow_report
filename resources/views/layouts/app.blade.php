<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="icon" href="{{ asset('images/logo.jpg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- PWA  -->
    <meta name="theme-color" content="#ffffff"/>
    <link rel="apple-touch-icon" href="{{ asset('images/logo.jpg') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Primary Meta Tags -->
    <title>550 MCH Biopsy Report With ICSH Guidelines</title>
    <meta name="title" content="Biopsy Report With ICSH Guidelines">
    <meta name="description" content="Can report for bonemarrow aspirate,bonemarrrow trephine, histological report and cytological report in one place.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://bonemarrowreport.com">
    <meta property="og:title" content="Biopsy Report With ICSH Guidelines">
    <meta property="og:description" content="Can report for bonemarrow aspirate,bonemarrrow trephine, histological report and cytological report in one place.">
    <meta property="og:image" content="{{ asset('images/app.png') }}">

    @yield('head')
</head>
<body class="bg-body">
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<div class="container-fluid">
    <div id="spinner"
         class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <span class="loader"></span>
    </div>
    <div class="row">
        @include('layouts.sidebar')
        <div class="col-12 col-lg-9 col-xl-10 vh-100 py-3 content">
            @include('layouts.header')
            <div class="container-fluid px-0">
                @yield('content')
            </div>
            <div class="my-5"></div>
        </div>
    </div>
</div>

@yield('foot')
<script src="{{ asset("js/app.js") }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>

@stack('script')

@if(session('status'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            title: '{{ session('status') }}'
        })
    </script>

@endif

@if(session('success'))
    <script>
        Swal.fire(
            'Success',
            '{{ session('success') }}',
            'success'
        )
    </script>
@endif

@if(session('message'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'အချက်အလက်မှားယွင်းနေပါသည်။',
            text: "{{ session('message') }}",
        })
    </script>
@endif

@if(session('denied'))
    <script>
        Swal.fire({
            icon: 'error',
            text: "{{ session('denied') }}",
        })
    </script>
@endif

<script>


    new VenoBox({
        selector: '.venobox',
        height : 900
    });

    function askConfirm(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "ဖျက်မှာသေချာပါသလား?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1266f1',
            cancelButtonColor: '#ff0000',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delForm' + id).submit();
            }
        })
    }

    function makeAdmin(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Role ပြောင်းလဲလိုက်လျှင် Admin လုပ်ပိုင်ခွင့်များရရှိသွားမှာဖြစ်ပါတယ်။",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1266f1',
            cancelButtonColor: '#ff0000',
            confirmButtonText: 'Yes, I Agree'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#makeAdminForm' + id).submit();
            }
        })
    }


    function changeConfirm(){
        Swal.fire({
            title: 'Are you sure?',
            text: "အချက်အလက်ပြောင်းမှာ သေချာပါသလား?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1266f1',
            cancelButtonColor: '#ff0000',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#changeForm').submit();
            }
        })
    }
</script>

</body>
</html>
