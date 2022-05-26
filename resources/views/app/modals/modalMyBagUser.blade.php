@if(Auth::user()->orders)
<div class="accordion" id="accordionorder">
    @forelse (Auth::user()->orders as $order)
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{$order->id}}">
        <h2 class="mb-0 col">
            <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse-{{$order->id}}" aria-expanded="true" aria-controls="collapse-{{$order->id}}">
                @php 
                @endphp
                <strong>Cod# {{$order->id}}</strong> 
                
            </button>
            
        </h2>
        <div class="price-order col font-bold">
           Valor R$ {{number_format($order->price_total)}}
        </div>
        <div class="qtItems col font-bold">
            Qt Itens ({{@count($order->orderProduct)}})
        </div>
        <div class="status col">
            @switch($order->status)
                @case(0)
                        <p class="bg-red-300 text-red-600 font-bold px-2 rounded-lg">Cancelado</p>
                    @break
                @case(1)
                        <p class="bg-blue-300 text-blue-600 font-bold px-2 rounded-lg">Enviado</p>
                    @break
                @case(2)
                        <p class="bg-emerald-300 text-emerald-600 font-bold px-2 rounded-lg">Recebido</p>
                    @break
                @case(3)
                        <p class="bg-yellow-300 text-yellow-600 font-bold px-2 rounded-lg">Sendo Preparado</p>
                    @break
                @case(4)
                        <p class="bg-teal-300 text-teal-600 font-bold px-2 rounded-lg">Saiu para entrega</p>
                    @break
                @case(5)
                        <p class="bg-green-300 text-green-600 font-bold px-2 rounded-lg">Entrengue</p>
                    @break
                @default
                    
            @endswitch
        </div>

        <div class="icon">
          Data {{date('d/m/Y', strtotime($order->created_at))}}
        </div>
        </div>
    
        <div id="collapse-{{$order->id}}" class="collapse" aria-labelledby="heading-{{$order->id}}" data-parent="#accordionorder">
        <div class="card-body">
            @foreach($order->orderProduct as $orderItem)
                @foreach($orderItem->productOrder as $prod)
                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div class="nama col text-sm font-bold">{{$prod->name}}</div>
                    <div class="nama col text-sm font-bold">Qt  {{($orderItem->quantity)}}</div>
                    <div class="nama col text-sm font-bold">Valor R$ {{number_format($orderItem->price, 2,',','.')}}</div>
                    <div class="nama col text-sm font-bold">Tamanho @if($orderItem->sizeText != null) {!!$orderItem->sizeText!!} @else NÃO DEFINIDO @endif</div>
                </div>
                @endforeach
            @endforeach
        </div>
        </div>
    </div>
    @empty
        
    @endforelse
    
</div>
@else

@endif