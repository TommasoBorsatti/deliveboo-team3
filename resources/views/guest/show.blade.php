@extends('layouts.guest')

@section('page_title')
    {{ $restaurant->restaurant }}
@endsection

@section('contentGuest')
<div id="rest_show">
    <div v-for="plate in plates">
        @{{ plate.name }}
    </div>

    
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
        el: '#rest_show',
        data: {
            plates: [

            ],
            cart: []
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