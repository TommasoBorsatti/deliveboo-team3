@extends('layouts.guest')

@section('page_title')
    CiBoo
@endsection

@section('contentGuest')
<div class='mt-40' id="app">
    
    <div class="main_container">
        <h1 class='main_title mt-20 mb-25'>La Selezione di CiBoo</h1>
        <div class="mosaic_container">
            <div v-for="(category, index) in categories" v-on:click="categoriesSearch(index, category.name)" class="category_card" :class="'cat' + category.name"> 
                <a class= "ancora" href="#restaurants"></a>   
            </div>
        </div>

    </div>

    
    <section id='restaurants' v-if= "categoryName != ''">
        <div class="main-container">
            <h2>Ecco i risultati della tua ricerca per: @{{categoryName}}</h2>
            <div class="restaurant-container flex">
                <div v-for='(restaurant,index) in restaurants' class="restaurant-card flex">
                    <div class="restaurant_card_textbox">
                        <h3>@{{restaurant.restaurant}}</h3>
                        <h4 class="mt-10 mb-10">@{{restaurant.address}}</h4>
                        <h5 class= "mt-10 mb-10 mr-10 category_tag" v-for='category in restaurant.categories'>@{{category.name}}</h4>
                    </div>
                    <div class="restaurant_img_box">
                        <img :src='images[index]' class='restaurant-img' alt="immagine ristorante">
                    </div>
                    <div class="button-box flex">
                        <button class='mt-10 mb-5'>Visita la pagina del ristorante</button>
                    </div>
                    <a :href="'http://localhost:8000/restaurant/'+ restaurant.id"></a>
                </div>
            </div>

        </div>
        
    </section>

    
</div>   

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/guest_index_search.js')}}"></script>
@endsection
 


