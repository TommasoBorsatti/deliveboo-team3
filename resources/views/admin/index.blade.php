@extends('layouts.base')

@section('page_title')
   Dashboard di: {{ $user->restaurant }}
@endsection

@section('content')
    <div class="container" id="root">
        <h1 class="mb-3">Dashboard di: {{ $user->restaurant }}</h1>
        <div class="mb-3 text-right">
            <a href="{{route('admin.plate.create')}}"><button type="button" class="btn btn-success"> Aggiungi Piatto</button></a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Immagine</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Disponibile</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($plates as $plate)
                <tr>
                    <td><img src="{{asset('storage/' . $plate->plate_img)}}" alt="{{$plate->name}}" style="width: 100px"></td>
                    <td>{{$plate->name}}</td>
                    <td>{{$plate->price}}</td>
                    <td>{{ $plate->available ? 'Si' : 'no'}}</td>
                    <td>
                        
                        <a href="{{route('admin.plate.edit', $plate->id )}}"><button type="button" class="btn btn-success"></button></a>
                        <form action="{{route('admin.plate.destroy', [ 'plate' => $plate->id ])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-danger"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if (session('message'))
            <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 30px">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-deck">
            @foreach ($plates as $plate)
            <div class="card">
                <img src="{{asset('storage/' . $plate->plate_img)}}" class="card-img-top" alt="{{$plate->name}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $plate->name }}</h5>
                    <h3>{{ $plate->price }} &euro;</h3>
                    <p class="card-text">{{ $plate->description }}</p>
                    <p>Disponibile: {!! $plate->available ? '<i class="far fa-check-circle"></i>' : '<i class="far fa-times-circle"></i>'!!}</p>
                </div>
                <div class="card-footer">
                    <a href="{{route('admin.plate.edit', $plate->id )}}"><button type="button" class="btn btn-success "><i class="fas fa-pencil-alt"></i></button></a>
                    <button  v-on:click="show = true" v-if="show == false" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                    
                    <div v-if="show == true" class="d-inline">
                        
                        <form class="d-inline" action="{{route('admin.plate.destroy', [ 'plate' => $plate->id ])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <button type="submit" class="btn btn-danger">si </button>
                            
                        </form>
                        
                        <button v-on:click="show = false"  class="btn btn-danger">no</button>
                    </div>
                        
                </div>
            </div>             
            @endforeach           
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/admin_index.js')}}"></script>    
@endsection
