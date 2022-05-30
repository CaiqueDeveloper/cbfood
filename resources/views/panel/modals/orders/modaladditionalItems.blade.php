<h1>Adicionais/e ou Complemento</h1>
@foreach ($additionalItems as $item)
<strong>{{$item->name}} - R$ {{$item->price}}</strong><br>
@endforeach