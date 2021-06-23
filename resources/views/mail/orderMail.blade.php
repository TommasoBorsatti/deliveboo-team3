<h1>Nome del ristorante ha accettato il tuo ordine!</h1>

<div>
    <h2>Ottima scelta, {{ $order->name_ui }}</h2>
    <div>
        <h4>Dati riepilogo ordine:</h4>
        <ul>
            <li>{{ $order->name_ui }}</li>
            <li>{{ $order->lastname_ui }}</li>
            <li>{{ $order->email_ui }}</li>
            <li>{{ $order->address_ui }}</li>
            <li>{{ $order->phone_ui }}</li>
        </ul>
        <h4>L'id del tuo ordine è: {{$order->id}}</h4>

        <h5>Totale: {{ $order->total }}€</h5>
    </div>
	<p>Grazie per aver scelto <a href="{{route('search')}}">CiBoo</a></p>
	
</div>