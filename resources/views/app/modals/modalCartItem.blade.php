@if(@count($cartItens) > 0)
    @foreach ($cartItens as $item)    
        <div class="row shadow my-3 sm:mr-3 sm:ml-3 ">
            <div class="col bg-cover bg-no-repeat bg-center  items-center rounded-t-lg h-20" style="background-image: url('{{$item->attributes->image}}')" ></div>
            <div class="col flex items-center justify-center">{{$item->name}}</div>
            <div class="col flex items-center justify-center">@if($item->attributes->sizeText != ""){!!$item->attributes->sizeText!!} @else SEM VARIAÇÃO @endif</div>
            <div class="col flex items-center justify-center">
                <input type="number" class="col-6 border rounded-lg" autofocus name="quatity" data-id_product="{{$item->id}}" value="{{$item->quantity}}">
            </div>
            <div class="col flex items-center justify-center text-red-300 cursor-pointer remove-item-cart" data-id_item-cart="{{$item->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash text-red" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
            </div>
        </div>
    @endforeach
    <div class="sm:mr-3 sm:ml-3">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-700 my-3">Total R$ {{ Cart::getTotal() }}</h1>
        
    </div>
    <div class="checout sm:mr-3 sm:ml-3 my-4 flex items-center">
        <div class="add-cart bg-green-300 text-green-600 font-bold p-2 rounded-xl mr-4 cursor-pointer flex items-center">Proximo 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill ml-2" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
            </svg>
        </div>
        <div class="closed-modal bg-red-300 text-red-600 font-bold p-2 rounded-xl cursor-pointer clear-cart flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash text-red" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
        </div>
    </div>
@else
    <div class="bg-red-300 text-red-600 font-bold p-2 rounded-xl">
        Seu Carrinho está vazio.
    </div>
@endif