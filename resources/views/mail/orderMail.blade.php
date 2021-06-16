<h1>Nuovo ordine</h1>
<div>
    <h2>Caro {{ $order->name_ui }} {{$order->lastname_ui}} </h2>
    <div>
        <h4>L'ordine con id: {{$order->id}}, che include:</h4>
        <ul>
            @foreach ($order->plates as $plate)
                <li>
                    {{$plate->name }} prezzo: {{$plate->price }}€
                </li>
            @endforeach
        </ul>
        <h5>Il totale è: {{ $order->total }}€</h5>
        <h3>è avvenuto con {{ $order->status == 'success' ? 'successo' : 'insuccesso'}}.</h3>
    </div>
	
	<a href="{{route('search')}}">CiBoo</a>
</div>