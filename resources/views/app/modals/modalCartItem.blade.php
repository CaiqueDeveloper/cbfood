
<p class="text-2xl my-2 font-extrabold text-black">Carrinho</p>
@if(@count($cartItens) > 0)
    @foreach ($cartItens as $item)  
        <section class="cart-item-model mt-3 mr-3 shadow my-3 sm:mr-3 sm:ml-3 p-2" >
            <div class="content-info-product grid grid-cols-2 col-span-2">
                <section>
                    <div class="title-product text-black font-bold text-sm mb-2">{{$item->name}}</div>
                    <div class="title-product  font-bold text-sm">
                        @if($item->description != null)
                            {{$item->description}}
                        @else
                            Não temos mais informações disponível sobre esse produto
                        @endif
                    </div>
                </section>
                <section class="bg-cover bg-no-repeat bg-center" style="background-image: url('{{$item->attributes->image}}')" ></section>
            </div>
            <div class="footer-content-product mt-3 flex  justify-around">
                <section class="font-bold text-green-600">
                    R$ {{number_format($item->price,2,",",".")}}
                </section>
                <section>
                    <div class="product-content-info--qtarea flex items-center  h-[30px] rounded-[10px] px-[10px]">
                        <input type="number" class="border rounded-lg text-center w-[100px]" autofocus name="quatity" data-id_product="{{$item->id}}" value="{{$item->quantity}}">
                    </div>
                </section>
                <section>
                    <div class="col flex items-center justify-center text-red-300 cursor-pointer remove-item-cart" data-id_item-cart="{{$item->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash text-red" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </div>
                </section>
            </div>
        </section>
    @endforeach
    <div class="sm:mr-3 sm:ml-3">
        <h1 class="text-xl sm:text-2xl font-bold text-black my-3 total-price">R$ {{ number_format(Cart::getTotal(),2,",",".") }}</h1>
        
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