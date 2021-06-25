@extends('layouts.base')

@section('page_title')
    Modifica: {{ $plate->name }}
@endsection

@section('content')

<div class="container pt-5 pb-5">
    <h1 class="mb-5 blue_text   ">Modifica: {{ $plate->name }}</h1>
    <form class="mt-3" action="{{route('admin.plate.update', $plate->id ) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{old('name') ? old('name') : $plate->name }}" placeholder="Inserisci il nome del piatto" required>
        </div>
        <div class="form-group">
            <label for="price">Prezzo</label>
            <input type="number" class="form-control" id="price" step="0.01" name="price" value="{{old('price') ? old('price') : $plate->price }}" placeholder="Inserisci il prezzo del piatto" required>
        </div>
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control"  name="description" id="description" cols="30" rows="10"  placeholder="Inserisci una descrizione per il tuo piatto">{{old('description') ? old('description') : $plate->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="plate_img">Carica un'immagine per il tuo piatto</label>
            <img src="{{asset('storage/' . $plate->plate_img)}}" class="d-block mb-3" width="100" alt="">
            <input type="file" class="d-block" id="plate_img" name="plate_img" value="{{ $plate->plate_img }}">
        </div>
        <div class="mt-4">
            <h3>Seleziona la disponibilità del piatto:</h3>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="available" name="available" {{ $plate->available == 1 ? 'checked' : ''}} >
                <label class="form-check-label" for="available">Disponibile per l'acquisto</label>
            </div>
        </div>
        <div class="mt-4">
            <h3>Seleziona la tipologia del piatto:</h3>
            @foreach ($types as $type)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$type->id}}" id="{{$type->name}}" name="types[]" {{ $plate->types->contains($type) ? 'checked' : ''}} >
                    <label class="form-check-label" for="{{$type->name}}">
                        {{$type->name}}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn_custom">Modifica piatto</button>
        </div>
    </form>
</div>

@endsection