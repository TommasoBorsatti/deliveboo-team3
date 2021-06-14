@extends('layouts.base')

@section('page_title')
   Dashboard di: {{ $user->restaurant }}
@endsection

@section('content')
    <div class="container">
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
                        
                        {{-- <a href="{{route('user.plate.edit', [ 'plate' => $plate->id ])}}"><button type="button" class="btn btn-success"></button></a> --}}
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
    </div>
@endsection
