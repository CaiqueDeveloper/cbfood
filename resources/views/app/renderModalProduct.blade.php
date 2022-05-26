<div class="announcementModalArea  w-full h-screen fixed top-0 left-0 bg-[#33333387] z-[100] flex items-center justify-center overflow-y-auto"  data-company_id="{{$product['product']->product_morph_id}}">
    <div class="content-product-item bg-white w-full sm:max-w-[750px] rounded-lg">
        <div class="content-product-imgs relative overflow-hidden">
            <div class="img-product w-full min-h-[300px] mb-4  bg-cover bg-no-repeat bg-center flex items-center rounded-t-lg" style="background-image: url('/product_photo/{{$product['product']->images->last()->path}}')">
            <div class="contente-product-imgs-controls w-full flex justify-between hidden">
                <div class="prev w-[50px] h-[50px] bg-white text-orange-600 rounded-full text-center shadow-lg shadow-orange-500/50 cursor-pointer ml-3 leading-[45px] font-bold text-2xl"><</div>
                <div class="next w-[50px] h-[50px] bg-white text-orange-600 rounded-full text-center shadow-lg shadow-orange-500/50 cursor-pointer mr-3 leading-[45px] font-bold text-2xl">></div>
            </div>
        </div>
        <div class="content-product-name mr-3 ml-3 my-3">
            <h1 class="text-xl sm:text-4xl font-bold text-black-600 product-name">{{$product['product']->name}}</h1>
            <div class="content-produc-category flex mt-3">
                <p class="text-sm text-black-600 font-bold" >Categoria:</p> <p class="text-sm  font-bold bg-orange-300 text-orange-600 ml-2 rounded-lg px-1">{{$product['product']->category->name}}</p>
            </div>
        </div>
        @if($product['product']->description != null)
        <div class="content-product-descritpion mr-3 ml-3">
            <h1 class="text-xl sm:text-2xl font-bold text-black-600">Sobre o Produto</h1>
            <article>
                <p class="text-gray-300 font-bold">{{$product['product']->description}}</p>
            </article>
        </div>
        @else
            <h1 class="text-xl sm:text-2xl font-bold text-gray-300 mr-3 ml-3">Esse Produto não possue descrição.</h1>
        @endif
        @if(@count($product['product']->variations) > 0)
            @php
                $maxValue = max($product['product']->variations->toArray());
                $maxValue['variationPrice'];
            @endphp
            <div class="mr-3 ml my-3"> 
                <h1 class="text-xl sm:text-2xl font-bold text-black-600 mr-3 ml-3">Selecione o tamanho desejado</h1>
                <div class="product-content-info-sizes flex flex-wrap sm:flex-nowrap my-3">
                    @foreach ($product['product']->variations as $key => $value)
                        <div data-key="{{$key}}" data-price_variation_product="{{$value['variationPrice']}}" data-variation_id="{{$value['id']}}"class="product-content-info-size mb-2 col col-sm-2 @if($maxValue['variationPrice'] == $value['variationPrice']) bg-orange-300 @endif border-2 border-orange-300 font-medium hover:bg-orange-300 px-[10px] ml-2 py-[15px] text-orange-600 hover:text-white cursor-pointer text-sm rounded-lg font-extrabold">{{$value['variationName']}}<span class="ml-2 text-orange-600 text-xs">{{$value['variationType']}}</span></div>   
                    @endforeach 
                </div>
            </div>  
        @endif
        @if(@count($product['additionals']) > 0)
            <div class="content-product-additionals mr-3 ml-3 mb-3">
                <h1 class="text-xl sm:text-2xl font-bold text-black-600 my-3">Adicionais/ e ou Complementos</h1>
                <div class="accordion" id="accordionAdditional">
                    @forelse ($product['additionals'] as $additional)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" id="heading-{{$additional->id}}">
                        <h2 class="mb-0 col">
                            <button class="btn btn-block text-left shadow-none" type="button" data-toggle="collapse" data-target="#collapse-{{$additional->id}}" aria-expanded="true" aria-controls="collapse-{{$additional->id}}">
                                <strong>Adicionais# {{$additional->name}}</strong> 
                            </button>
                        </h2>
                        </div>
                        <div id="collapse-{{$additional->id}}" class="collapse" aria-labelledby="heading-{{$additional->id}}" data-parent="#accordionAdditional">
                        <div class="card-body">
                            @foreach ($additional->items as $item)
                                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" id="{{$item->id}}" value="{{$item->id}}" name="items[]" type="checkbox">
                                        <label class="form-check-label" for="{{$item->id}}" style="cursor: pointer">{{$item->name}}</label>
                                    </div>
                                    R$ {{$item->price}}
                                </div>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                    
                </div>
            </div>
        @endif
        <div class="product-content-total-price mr-3 ml-3 mb-3 flex flex-column justify-start text-xl sm:text-1xl mr-3 mt-3 ">
            <h1 class="text-xl sm:text-2xl font-bold text-black-600 my-3">@if(@count($product['product']->variations) < 0)Valor/Quantidade @else Informe o valor e quantidade desejada @endif</h1>
            <div class="price-product flex">
                <p class="font-bold mr-2">R$</p>
                @if(@count($product['product']->variations) > 0)
                    <div class="price-product-selected">
                        {{$maxValue['variationPrice']}}
                    </div>
                @else
                <input type="number" name="priceCliente" class="outline-none w-[120px]" placeholder="Ex: 30.00">
                @endif
                <div class="product-content-info--qtarea flex items-center  h-[30px] rounded-[10px] px-[10px]">
                    <button class="product-content-info--qtmenos  px-[10px] text-lg bg-orange-600 text-white font-bold rounded-lg">-</button>
                    <div class="product-content-info--qt mx-3 font-bold">1</div>
                    <button class="product-content-info--qtmais px-[10px] text-lg bg-orange-600 text-white font-bold rounded-lg">+</button>
                </div>
            </div>
            
        </div>
        <div class="row mt-3">
            <div class="col-md-12 mr-3 ml-3 font-bold text-2xl">
                <h3>Observações</h3>
            </div>
            <div class="mt-2 col mr-3 ml-3">
                <div class="mb-0 input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                              </svg>
                            </span>
                        </div>
                        <textarea placeholder="Escreva observações..." aria-label="With textarea"  name="comments" class="checkout-comments form-control observation-user"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-content-add-cart mr-3 ml-3 my-4 flex items-center">
            <div class="add-cart bg-green-300 text-green-600 font-bold p-2 rounded-xl mr-4 cursor-pointer" data-product_id="{{$product['product']->id}}">Adicionar ao Carrinho</div>
            <div class="closed-modal bg-red-300 text-red-600 font-bold p-2 rounded-xl cursor-pointer">Cancelar</div>
        </div>
    </div>
</div>