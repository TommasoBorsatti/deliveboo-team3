@extends('layouts.guest')

@section('page_title')
    {{ $restaurant->restaurant }}
@endsection

@section('contentGuest')
<div>
    <ul>
        @foreach ($restaurant->plates as $plate)
        <li> {{ $plate->name }} </li>
        @endforeach
    </ul>
    
</div>   
@endsection