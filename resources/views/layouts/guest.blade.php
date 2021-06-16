<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.30.0/js/dropin.js"></script>
    <link rel="stylesheet" href="{{asset('css/guest.css')}}">
</head>
<body>

    @include('parts.guest.header')

    <main>
        @yield('contentGuest')
    </main>

    @include('parts.guest.footer')
    
</body>
</html>