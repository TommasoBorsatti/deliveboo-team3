@extends('layouts.guest')

@section('page_title')
    
@endsection

@section('contentGuest')
<form  action="{{route('restaurant.checkout.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div >
        <label for="name_ui">Nome</label>
        <input type="text"  id="name_ui" name="name_ui"  placeholder="Inserisci il nome" required>
    </div>
    <div >
        <label for="lastname_ui">Cognome</label>
        <input type="text" id="lastname_ui" name="lastname_ui"  placeholder="Inserisci il cognome" required>
    </div>
    <div >
        <label for="email_ui">Email</label>
        <input type="email"  name="email_ui" id="email_ui" placeholder="Inserisci l'email" required>
    </div>
    <div >
        <label for="address_ui">Inserisci l'indirizzo</label>
        <input type="text"  id="address_ui" name="address_ui" >
    </div>
    <div>

        <label  for="phone_ui">Inserisci il numero di telefono</label>
        <input  type="tel" id="phone_ui" name="phone_ui">  

    </div>

    
    
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">paga</button>
    </div>
</form>  
@endsection