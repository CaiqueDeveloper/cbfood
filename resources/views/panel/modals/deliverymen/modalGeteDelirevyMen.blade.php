<table class="table table-info">
    <thead>
        <tr>
            <th>Entregador</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($deliverymen as $key => $deliverie)
            <tr>
                @if($deliverie->profiles[0]['name'] == 'deliveryman' )

                <td>{{$deliverie->name}}</td>
                <td class="text-center">
                    <a href="#" class="text-info sendOrderToDeliveryPerson" value="{{$deliverie->id}}" data-order_id="{{$id}}">
                        <i class="bi bi-send-check-fill"></i>
                    </a>   
                </td>
                @endif
            </tr>
        @empty    
            
        @endforelse
    </tbody>
</table>