<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comanda do Pedido</title>
    {{-- tailwindcss --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="flex items-center justify-center sm:text-4xl font-bold text-gray-900 "style="margin-right: -50px">    
        <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt=""><p>CbFood.</p>
    </header>
    <div class="content-dcoment-pdf flex flex-col items-center	 justify-center" style="margin-right: -50px">
        <h1 class="my-4 text-2xl text-gray-600 font-bold">Código do Pedido {{$auxOrder['orderCod']}}#</h1>
        <div class="body-order flex flex-col items-center">
            =========== INFORMAÇÕES DO PEDIDO ===========
            <strong class="text-gray-600 font-bold">Cliente Solicitante: {{$auxOrder['orderUser'][0]['name']}}</strong>
            <strong class="text-gray-600 font-bold">Contato: {{$auxOrder['orderUser'][0]['number_phone']}}</strong>
            <strong class="text-gray-600 font-bold">Solcitado Em: {{$auxOrder['orderDate']}}</strong>
            <strong class="text-gray-600 font-bold">Valo do Pedido: {{$auxOrder['orderTotalPrice']}}</strong>
            <strong class="text-gray-600 font-bold">pagamento: {{$auxOrder['orderPaymentMethod']}}</strong>
            <strong class="text-gray-600 font-bold">Troco: {{$auxOrder['orderThing']}}</strong>
            <strong class="text-gray-600 font-bold">Quantidade de Itens: {{$auxOrder['orderQtItem']}}</strong>
            =============== Itens do Pedido =============== 
            @foreach ($auxOrder['orderItem'] as $item)
                @foreach($item->productOrder as $prod)
                    <strong class="text-gray-600 font-bold">Item: {{$prod->name}} - Qt {{$item->quantity}} - R$ {{number_format($item->price,2,",",".")}}</strong>
                    <strong class="text-gray-600 font-bold">Observações: @if($item->observation != "") {{$item->observation}} @else   SEM OBSERVAÇÕES @endif</strong>
                    @if(@count($item['additional']) > 0)
                    =============== Adidicionais ===============
                    @foreach($item['additional'] as $additional)
                        <strong class="text-gray-600 font-bold"> {{$additional->name}} - R$ {{number_format($additional->price,2,",",".")}}</strong>
                    @endforeach
                    @endif
                    ===========================================
                @endforeach
            @endforeach
            <br>
           ============= Endereço de Entega =============
            <strong class="text-gray-600 font-bold">Rua: {{$auxOrder['orderAddressUser']->road}}</strong>
            <strong class="text-gray-600 font-bold">Bairro: {{$auxOrder['orderAddressUser']->distric}}</strong>
            <strong class="text-gray-600 font-bold">Nª: {{$auxOrder['orderAddressUser']->number}}</strong>
            <strong class="text-gray-600 font-bold">Cidade: {{$auxOrder['orderAddressUser']->city}}</strong>
            <strong class="text-gray-600 font-bold">CEP: {{$auxOrder['orderAddressUser']->zipe_code}}</strong>
            <strong class="text-gray-600 font-bold">Estado: {{$auxOrder['orderAddressUser']->states}}</strong>
            <strong class="text-gray-600 font-bold">Ponto de Referêcia: {{$auxOrder['orderAddressUser']->complement}}</strong>
        </div>
    </div>
</body>
</html>