@extends('layouts.guest-nojumbo')

@section('page_title')
    {{ $restaurant->restaurant }}
@endsection

@section('contentGuest')
<div id="rest_show">

    <div class="main-container">

        <div class="restaurant_title_box mb-20 mt-20">
            <h1 class="restaurant_title">Effettua il tuo ordine da {{$restaurant->restaurant}}:</h1>
        </div>

        <section id="plates" class="flex">
            <div class="menu_box flex">
                <div v-for="plate in plates" class="plate_card">
                    <h2 class="mb-15">@{{plate.name}}</h2>
                    <img :src= "'http://localhost:8000/storage/'+ plate.plate_img" :alt="plate.name" class="mb-15 menu_img">
                    <h3 class="mb-15">@{{plate.price}} €</h3>
                    <p class="plate_description mb-15">@{{plate.description}}</p>
                    <h5 v-for='type in plate.types' class="type_tag">@{{type.name}}</h5>
                </div> 
            </div>
            <div class="cart_box">
                <div class="cart_title_box mb-20 mt-20">
                   <h3 class="cart_title">Il tuo ordine per: <em>{{$restaurant->restaurant}}</em></h3>
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
            plates: [

            ],
            cart: [],

        },
        mounted:function(){
            axios.get('http://localhost:8000/api/restaurant-plates',{
                params: {
                    id : {{ $restaurant->id }} 
                }
            })
          .then((result) => {
            this.plates = result.data;            

          });
        },

        methods:{
            
        }
    });
</script>
@endsection