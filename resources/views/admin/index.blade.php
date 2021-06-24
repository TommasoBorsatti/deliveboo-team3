@extends('layouts.base')

@section('page_title')
   Dashboard di: {{ $user->restaurant }}
@endsection

@section('content')
    <div class="container mb-5" id="root">
        <h1 class="mb-3 mt-20 dash_title">Dashboard di: {{ $user->restaurant }}</h1>
        {{-- Messaggio di alert cancellazione da rivedere --}}
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="mb-3 text-right">
            <a href="{{route('admin.plate.create')}}"><button type="button" class="btn btn_custom"> Aggiungi Piatto</button></a>
        </div>
        
        <div class="card-deck">
            @foreach ($plates as $plate)
            <div class="card card_custom">
                <img src="{{asset('storage/' . $plate->plate_img)}}" class="card-img-top" alt="{{$plate->name}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $plate->name }}</h5>
                    <h3>{{ $plate->price }} &euro;</h3>
                    <p class="card-text">{{ $plate->description }}</p>
                    <p>Disponibile: {!! $plate->available ? '<i class="far fa-check-circle yes_icon"></i>' : '<i class="far fa-times-circle no_icon"></i>'!!}</p>
                    @foreach ($plate->types as $type)
                        <h5 class='type_tag'> {{ $type->name }}</h5>
                    @endforeach
                </div>
                <div class="card-footer">
                    <a href="{{route('admin.plate.edit', $plate->id )}}"><button type="button" class="btn btn_custom "><i class="fas fa-pencil-alt"></i></button></a>
                    
                     <div class="d-inline"> 
                        
                        <form class="d-inline" action="{{route('admin.plate.destroy', [ 'plate' => $plate->id ])}}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare il piatto?');">
                            @csrf
                            @method('DELETE')
                            
                            <button type="submit" class="btn btn_delete"><i class="far fa-trash-alt"></i></button>      
                        </form>
                        
                        {{-- <button v-on:click="show = false"  class="btn btn_delete">no</button> --}}
                    </div>
                        
                </div>
            </div>             
            @endforeach           
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/admin_index.js')}}"></script>    
@endsection
