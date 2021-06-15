@extends('layouts.guest')

@section('page_title')
    CiBoo
@endsection

@section('contentGuest')
<div id="app">
    <select v-model="category" v-on:change="categoriesSearch">
        <option value="">Scegli la categoria</option>
        @foreach ($categories as $category)
            
            <option  v-bind:value="{{ $category->id }}">
                {{ $category->name }}
            </option>
            
        @endforeach
    </select>
    <ul v-if="category != ''">
        <li v-for="restaurant in restaurants">
            @{{ restaurant.restaurant }}
        </li>
    </ul> 

    <ul v-else>
        @foreach ($users as $user)
            <li>
                {{ $user->restaurant }}
            </li>
        @endforeach
    </ul>
</div>   
@endsection
 
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/guest_index_search.js')}}"></script>

