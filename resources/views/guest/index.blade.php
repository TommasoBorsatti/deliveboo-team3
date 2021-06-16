@extends('layouts.guest')

@section('page_title')
    CiBoo
@endsection

@section('contentGuest')
<div class='mt-40' id="app">
    
    <div class="main_container">
        <h1 class='main_title mt-20 mb-25'>La Selezione di CiBoo</h1>
        <div class="mosaic_container">
            <div v-for="(category, index) in categories" v-on:click="categoriesSearch(index)" class="category_card" :class="'cat' + category.name">    
            </div>
        </div>

        {{-- <!--SELECT DI VUE-->
        <select class="mt-40" v-model="category" v-on:change="categoriesSearch">
            <option value="">Scegli la categoria</option>
            @foreach ($categories as $category)
                
                <option  v-bind:value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                
            @endforeach
        </select> --}}

        <ul >
            <li v-for="restaurant in restaurants">
                @{{ restaurant.restaurant }}
                <a :href="'http://localhost:8000/restaurant/'+ restaurant.id">vai</a>
            </li>
        </ul> 

        {{-- <ul v-else>
            @foreach ($users as $user)
                <li>
                    {{ $user->restaurant }}
                </li>
            @endforeach
        </ul> --}}

    </div>

    
</div>   

<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/guest_index_search.js')}}"></script>
@endsection
 


