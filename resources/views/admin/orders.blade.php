@extends('layouts.base')

@section('page_title')
   Dashboard di: {{ $user->restaurant }}
@endsection

@section('content')
<div id="order">
    <div v-for="order in orders" >
        <p>@{{ order.id}}</p>
        <span> @{{ order.lastname_ui}} </span>
        <span> @{{ order.name_ui}} </span>
        <span> @{{ order.total}} </span>
    </div>
    <div style="width: 50%;">
        <canvas  id="myChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
        el: '#order',
        data: {
           orders: [],
           countOrder: []
        },
        mounted:function(){
            axios.get('http://localhost:8000/api/restaurant/orders',{
                params: {
                    id : {{ $user->id }} 
                }
            })
            .then((result) => {
                for (let i = 0; i < result.data.length; i++) {
                    if (!this.orders.some(orderId => orderId.id === result.data[i].id)) {
                        this.orders.push(result.data[i]);
                    }                   
                }
                for (let j = 0; j < 12; j++) {
                    var x = 0;
                    for (let i = 0; i < this.orders.length; i++) {
                        let date = new Date(this.orders[i].created_at)
                        if (date.getMonth() == j) { 
                            x++;
                        }                                                       
                    }
                this.countOrder.push(x);
                console.log(this.countOrder);   
                }                
            });
                     
        
            
            const labels = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];
            const data = {
                labels: labels,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: this.countOrder,
                }]
            };
            const config = {
                type: 'bar',
                data,
                options: {}
            };
            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        },
        methods:{
            
            
        }
    });
</script>
@endsection
