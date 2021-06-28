@extends('layouts.guest-nojumbo')

@section('page_title')
    Checkout del tuo Ordine
@endsection

@section('contentGuest')

<div class="main_container">

    <h1 class="mt-20">Checkout</h1>

    <div id="checkout_vue" class="checkout_container flex mb-20">
        <div class="cart_resume">
        
            <div class="cart_title_box mb-40 mt-20">
                <a href="{{route('restaurant.show', $restaurant->id)}}"><i class="fas fa-arrow-circle-left back-arrow"></i></a>
                <h3 class="cart_title mt-15">Il tuo carrello <i class="fas fa-cart-plus"></i> </h3>
            </div>
            <div  class="cart_plates_container mb-20">
                <div v-for="(item, index) in cart" class="cart_plate mb-15 flex">
                    <div>
                        <i class="mr-5">@{{item.quantity}}</i><span class="mr-10">&times;</span>
                        <h3>@{{item.name}}</h3>

                    </div>
                </div>

                
            </div>
            <div class="cart_total">
                <p class="mb-10"><strong>Totale:</strong> <span>@{{ total }}</span> &euro;</p>            
            </div>
            
        </div>
        
        <div class="order_box">
    
            <form id="pay_form" action="{{route('restaurant.checkout.store')}}" method="POST" enctype="multipart/form-data" class="order_form flex">
                @csrf
                @method('POST')
                <div  class="mb-20 mt-20 pt-10">
                    <h3>Dettagli di pagamento</h3>
                </div>
                <div class="mb-20" >
                    <label for="name_ui">Nome:</label>
                    <input type="text"  id="name_ui" name="name_ui"  placeholder="Inserisci il nome" required>
                </div>
                <div class="mb-20" >
                    <label for="lastname_ui">Cognome:</label>
                    <input type="text" id="lastname_ui" name="lastname_ui"  placeholder="Inserisci il cognome" required>
                </div>
                <div class="mb-20" >
                    <label for="email_ui">Email:</label>
                    <input type="email"  name="email_ui" id="email_ui" placeholder="Inserisci l'email" required>
                </div>
                <div class="mb-20">
                    <label for="address_ui">Indirizzo di consegna:</label>
                    <input type="text"  id="address_ui" name="address_ui" placeholder="Inserisci l'indirizzo di consegna" >
                </div>
                <div class="mb-10">
                    <label  for="phone_ui">Numero di telefono:</label>
                    <input  type="tel" id="phone_ui" name="phone_ui" placeholder="Inserisci il tuo numero di telefono">  
                </div>
            
                {{-- submit braintree --}}
                <div id="dropin-container"></div>
                <input id="nonce" name="payment_method_nonce" type="hidden" />

                <input id="total" type="hidden"  name="total">
                
                <input v-for="item in cart" class="plate_id" type="hidden" name="plate_id[]" :value="item.id">
            
            
                <button type="submit" class="empty_btn pay_btn mt-20 mb-30" > Effettua l'ordine </button>
            
            </form>
    
        </div>

    </div>

    
 
   

</div>  


<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
        el: '#checkout_vue',
        data: {
            cart: [],
            total: 0,
        },
        mounted:function(){
            if (localStorage.getItem('cart')) {
                try {

                    this.cart = JSON.parse(localStorage.getItem('cart'));
                } catch(e) {
                    localStorage.removeItem('cart');
                }
            }
            for (let i = 0; i < this.cart.length; i++) {
                this.total += this.cart[i].amount;           
            }
            var amount = this.total;
            var form = document.querySelector('#pay_form');
            var token = "{{ $token }}"
            function clearCart(){
                this.cart = [];
                this.total = 0;
                localStorage.total = this.total;
                const parsed = JSON.stringify(this.cart);
                localStorage.setItem('cart', parsed);
            } 
            console.log(token);
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
                        document.querySelector('#total').value = amount;
                        clearCart();
                        form.submit();
                    });
                })
            });
        },
    });
</script>
@endsection