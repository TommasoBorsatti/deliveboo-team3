
@extends('layouts.guest-nojumbo')

@section('page_title')
    Pagamento effettuato
@endsection

@section('contentGuest')
<div class="container">
    <h1 class="mt-50 success_title">Il tuo ordine è stato effettuato con successo!</h1>
    <img class='success_box' src="" alt="">
    <div class="mt-50 flex link_box">
        <a href="{{route('search')}}" class="link_success">-Torna all'HomePage-</a>
    </div>
    
</div>
@endsection