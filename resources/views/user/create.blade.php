@extends('layouts.base')

@section('page_title')
    Dashboard di: {{$user->restaurant}}
@endsection

@section('content')
<div class="container">
    <form class="mt-3" action="{{route('user.plate.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Inserisci il nome del piatto">
        </div>
        <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Inserisci il prezzo del piatto">
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control"  name="description" id="description" cols="30" rows="10" placeholder="Inserisci una descrizione per il tuo piatto"></textarea>
        </div>
        <div class="form-group">
            <label for="plate_img">Immagine</label>
            <input type="text" class="form-control" id="plate_img" name="plate_img" placeholder="Inserisci un'immagine per il tuo piatto">
        </div>
        <div class="mt-4">
            <h3>Seleziona la disponibilità del piatto:</h3>
            <div class="form-check form-check-inline ì">
                <input class="form-check-input" type="checkbox" id="available" name="available">
                <label class="form-check-label" for="available">Disponibile per l'acquisto</label>
            </div>
        </div>
        <div class="mt-4">
            <h3>Seleziona la tipologia del piatto:</h3>
            @foreach ($types as $type)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$type->id}}" id="{{$type->name}}" name="types[]">
                    <label class="form-check-label" for="{{$type->name}}">
                        {{$type->name}}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Aggiungi piatto</button>
        </div>
    </form>
</div>

@endsection