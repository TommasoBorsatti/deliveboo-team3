@extends('layouts.guest-nojumbo')

@section('page_title')
    {{ $restaurant->restaurant }}
@endsection

@section('contentGuest')
<div id="rest_show">

    <div class="main-container">

        <div class="restaurant_title_box mb-20 mt-20">
            <h2 class="restaurant_title">Effettua il tuo ordine da</h2>
            <h1 class='restaurant_name'>{{$restaurant->restaurant}}</h1>
        </div>

        <section id="plates" class="flex">
            <div class="menu_box flex">
                <div v-for="(plate, index) in plates" class="plate_card flex">
                    <div class="card_intro mb-15">
                        <h2 class="mb-15 card_title">@{{plate.name}}</h2>
                        <img :src= "'http://localhost:8000/storage/'+ plate.plate_img" :alt="plate.name" class="mb-15 menu_img">
                    </div>
                    <div class="plate_quantity flex mb-15">
                        <h3 class="mb-15 price">@{{plate.price}} €</h3>
                        <div class="quantity-box">
                            <input class="quantity mr-10 ml-10" type="number" v-model="plate.quantity" min="0" placeholder="Inserisci la quantità">
                            <button v-on:click="addCart(plate, index)" class="mt-15 add_btn">Aggiungi <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                    <div class="plate_info">
                        <p class="plate_description mb-15">@{{plate.description}}</p>
                    </div>
                    <div class="plate_types flex">
                        <h5 v-for='type in plate.types' class="type_tag">@{{type.name}}</h5>
                    </div>
                </div> 
            </div>
            <div class="cart_box">
                <div class="cart_title_box mb-40 mt-20">
                   <h3 class="cart_title">Il tuo carrello<i class="fas fa-cart-plus"></i> </h3>
                </div>
                <div  class="cart_plates_container mb-20">
                    <div v-for="(item, index) in cart" class="cart_plate mb-15 flex">
                        <div>
                            <i class="mr-5">@{{item.quantity}}</i><span class="mr-10">&times;</span>
                            <h3>@{{item.name}}</h3>
                        </div>
                        <i v-on:click="removeCart(index)" class="fas fa-trash-alt"></i>
                    </div>
                </div>
                <div class="cart_total">
                    <p class="mb-10"><strong>Totale:</strong> <span>@{{ total }}</span> &euro;</p>
                    <a href='{{route('restaurant.checkout', $restaurant->id)}}' class="empty_btn" v-if= 'cart.length > 0'>Vai al CheckOut</a>
                    <button class="empty_btn" v-on:click="clearCart"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
        el: '#rest_show',
        data: {
            plates: [],
            cart: [],
            total: 0,
            plateTotal: 0
        },
        mounted:function(){
            if (localStorage.getItem('cart')) {
                try {
                    this.cart = JSON.parse(localStorage.getItem('cart'));
                } catch(e) {
                    localStorage.removeItem('cart');
                }
            }
            if (localStorage.total) {
                this.total = parseFloat(localStorage.total);
            }
            axios.get('http://localhost:8000/api/restaurant-plates',{
                params: {
                    id : {{ $restaurant->id }} 
                }
            })
          .then((result) => {
            this.plates = result.data;
            for (let i = 0; i < this.plates.length; i++) {
                this.plates[i].quantity = 0;               
            }
          });
        },
        methods:{
            addCart: function( plate, index){
                if ( plate.quantity <= 0) {
                    return
                }
                
                if(!this.cart.some(cartPlate => cartPlate.name === plate.name)){
                    plate.amount = plate.price * plate.quantity;
                    this.cart.push(plate);
                    this.total = 0;
                    for (let i = 0; i < this.cart.length; i++) {
                        
                        this.total += this.cart[i].amount;                   
                    }
                localStorage.total = this.total;
                }   
                
                this.saveCart();                
            },
            removeCart: function(index){
                this.total -= this.cart[index].amount;
                localStorage.total = this.total;
                this.cart.splice(index, 1);               
                this.saveCart(); 
            },
            clearCart: function(){
                this.cart = [];
                this.total = 0;
                localStorage.total = this.total;
                this.saveCart(); 
            },
            saveCart: function(){
                const parsed = JSON.stringify(this.cart);
                localStorage.setItem('cart', parsed); 
            },
            
        }
    });
</script>
@endsection