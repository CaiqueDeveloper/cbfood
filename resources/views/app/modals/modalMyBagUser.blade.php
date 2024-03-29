@if(Auth::user())
<div class="accordion" id="accordionorder">
    @forelse (Auth::user()->orders as $order)
    <div class="card mt-[10px] ">
        <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{$order->id}}">
        <h2 class="">
            <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse-{{$order->id}}" aria-expanded="true" aria-controls="collapse-{{$order->id}}">
                @php 
                @endphp
                <strong class="">
                    <div class="icon-plus text-orange-600 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                        </svg>
                        <strong class="ml-2">Pedido</strong>
                    </div>
                    
            </button>
           
            
        </h2>
        <div class="status col">
            @switch($order->status)
                @case(0)
                        <p class="bg-red-300 text-red-600 font-bold px-2 rounded-lg text-center">Cancelado</p>
                    @break
                @case(1)
                        <p class="bg-blue-300 text-blue-600 font-bold px-2 rounded-lg text-center">Enviado</p>
                    @break
                @case(2)
                        <p class="bg-emerald-300 text-emerald-600 font-bold px-2 rounded-lg text-center">Recebido</p>
                    @break
                @case(3)
                        <p class="bg-yellow-300 text-yellow-600 font-bold px-2 rounded-lg text-center">Sendo Preparado</p>
                    @break
                @case(4)
                        <p class="bg-teal-300 text-teal-600 font-bold px-2 rounded-lg text-center">Saiu para entrega</p>
                    @break
                @case(5)
                        <p class="bg-green-300 text-green-600 font-bold px-2 rounded-lg text-center">Entrengue</p>
                    @break
                @default
                    
            @endswitch
        </div>

        <div class="icon text-center">
            Data {{date('d/m', strtotime($order->created_at))}}
        </div>
        <a href="#" class="desabled-order text-center text-center text-red-300 bg-red-600 px-1 rounded-lg @if($order->status != 1) hidden @endif" value="{{$order->id}}">
            Cancelar Pedido <i class="bi bi-x-circle-fill"></i>
        </a>    
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
<div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
    <p class="font-bold">Aviso</p>
    <p>Sua sacola está vazia.</p>
</div>
@endif