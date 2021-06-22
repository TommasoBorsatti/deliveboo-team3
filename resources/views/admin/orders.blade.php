@extends('layouts.base')

@section('page_title')
   Dashboard di: {{ $user->restaurant }}
@endsection

@section('content')
<div id="order">
    
    <div style="display: flex;">
        <div style="width: 40%;">
            <h2>Totale ordini per mese</h2>
            <canvas  id="myChart"></canvas>   
        </div>
        <div style="width: 40%;">
            <h2>Totale ordini per anno</h2>
            <canvas  id="chartYear"></canvas>
        </div>
    </div>
    <div v-for="order in orders" >
        <p>@{{ order.id}}</p>
        <span> @{{ order.lastname_ui}} </span>
        <span> @{{ order.name_ui}} </span>
        <span> @{{ order.total}} </span>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
        el: '#order',
        data: {
           orders: [],
           countOrder: [],
           countTotal: [],
           yearOrder: [],
           yearTotal: [],
           currentYear: new Date()
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
                    var totOrders = 0;
                    var amount = 0;
                    for (let i = 0; i < this.orders.length; i++) {
                        let date = new Date(this.orders[i].created_at)
                        if (date.getMonth() == j) { 
                            totOrders++;
                            amount += this.orders[i].total;
                        }                                                       
                    }
                this.countOrder.push(totOrders);
                this.countTotal.push(amount);                
                }
                this.currentYear = this.currentYear.getFullYear();
                for (let j = (this.currentYear - 2); j <= this.currentYear; j++) {
                    var totOrders = 0;
                    var amount = 0;
                    for (let i = 0; i < this.orders.length; i++) {
                        let date = new Date(this.orders[i].created_at)
                        if (date.getFullYear() == j) { 
                            totOrders++;
                            amount += this.orders[i].total;
                        }                                                       
                    }
                this.yearOrder.push(totOrders);
                this.yearTotal.push(amount);                
                }                
            });
            this.statsMonth();
            this.statsYear();                 
        },
        methods:{   
            statsMonth: function(){
                
                const labels = [
                    2019,
                    2020,
                    2021
                ];
                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Totale ordini nell\'anno',
                        axis: 'y',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: this.yearOrder,
                    },
                    {
                        label: 'Totale incasso nell\'anno',
                        axis: 'y',
                        backgroundColor: 'rgb(150, 99, 20)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: this.yearTotal,
                    }]
                };
                const config = {
                    type: 'bar',
                    data,
                    options: {
                        indexAxis: 'y',
                    }
                };
                var chartYear = new Chart(
                    document.getElementById('chartYear'),
                    config
                );
            },
            statsYear: function(){
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
                    label: 'Totale ordini',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: this.countOrder,
                },
                {
                    label: 'Totale incasso',
                    backgroundColor: 'rgb(150, 99, 20)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: this.countTotal,
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
            }
        }
    });
</script>
@endsection