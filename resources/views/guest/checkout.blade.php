@extends('layouts.guest')

@section('page_title')
    
@endsection

@section('contentGuest')
<form id="pay_form" action="{{route('restaurant.checkout.store')}}" method="POST" enctype="multipart/form-data">
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

    
    {{-- submit form guest --}}
    {{-- <div class="mt-3">
        <button type="submit" class="btn btn-primary">paga</button>
    </div> --}}

    {{-- submit braintree --}}
    <div id="dropin-container"></div>
    <input id="nonce" name="payment_method_nonce" type="hidden" />


    <button type="submit" > Pagamento </button>

    
</form>

<script>
    var form = document.querySelector('#pay_form');
    var token = "{{ $token }}"

    braintree.dropin.create({
    authorization: token,
    selector: '#dropin-container'
    }, function (err, instance) {
    form.addEventListener('submit',function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }
                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        })
    });
</script>  
@endsection