<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="Cbfood Delivery">
    <meta property="og:title" content="{{$product['product']->name}}" />
    <meta property="og:description" content="Plataforma de Delivery, densenvolvida pensando em você !" />
    <meta property="og:image" itemprop="image" content="{{$product['product']->images->first()}}">
    <meta property="og:image" content="{{$product['product']->images->first()}}">

    <!-- No need to change anything here -->
    <meta property="og:type" content="website" />
    <meta property="og:image:type" content="image/jpeg">

    <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">

    <!-- Website to visit when clicked in fb or WhatsApp-->
    <meta property="og:url" content="{{url()->current()}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cbfood - {{$product['company'][0]->name}}</title>

    {{-- tailwindcss --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <script src="{{asset('js/tailwindcss.js')}}"></script> --}}
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Custom fonts for this template-->
    <link href="{{url('theme-sdb-admin-2/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{url('theme-sdb-admin-2/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="icon" href="{{ url('panel/img/logo/icon-page.svg') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <title>Document</title>
</head>
<body>
<div class="content-product-item bg-white w-full sm:max-w-[750px] rounded-lg mx-auto pb-4 sm:mt-[75px]" >
    @if(@count($product['product']->images) > 1)
    <div class="relative">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg sm:h-64 xl:h-80 2xl:h-96 ">
            @foreach($product['product']->images as $key => $value)
            <div id="carousel-item-{{$key}}" class="duration-700 ease-in-out content-slide">
                <span class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                <img src="/product_photo/{{$value->path}}" class=" img-product absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            @endforeach
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            @foreach($product['product']->images as $key => $value)
            <button id="carousel-indicator-{{$key}}" type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"></button>
            @endforeach
        </div>
        <!-- Slider controls -->
        <button id="data-carousel-prev" type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif  group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden">Previous</span>
            </span>
        </button>
        <button id="data-carousel-next" type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif  group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="hidden">Next</span>
            </span>
        </button>
    </div>
    @else
    <div class="relative">
        <img src="/product_photo/@if(count($product['product']->images) > 0){{$product['product']->images->last()->path}}@else/default/default.jpg @endif" class=" img-product absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        
    </div>
    @endif
    <div class="content-product-name mr-3 ml-3 my-3">
        <h1 class="text-xl sm:text-4xl font-bold text-black-600 product-name">{{$product['product']->name}}</h1>
        <div class="content-produc-category flex mt-3">
            <p class="text-sm text-black-600 font-bold" >Categoria:</p> <p class="text-sm  font-bold  @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif ml-2 rounded-lg px-1">{{$product['product']->category->name}}</p>

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
                    <div data-key="{{$key}}" data-price_variation_product="{{$value['variationPrice']}}" data-bgColorItemSelect="@if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif"
                    data-variation_id="{{$value['id']}}"class="product-content-info-size mb-2 col col-sm-2 
                    @if($maxValue['variationPrice'] == $value['variationPrice']) @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif  @endif 
                    border-2 @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  border-orange-300 @endif   font-medium  @if($product['company']['settings'][0]->secondColor != null)  hover:bg-[{{$product['company']['settings'][0]->secondColor}}] @else  hover:bg-orange-300 @endif  
                    px-[10px] ml-2 py-[15px] @if($product['company']['settings'][0]->primaryColor != null) border-[{{$product['company']['settings'][0]->secondColor}}] @else  text-orange-600 @endif  hover:text-white cursor-pointer 
                    text-sm rounded-lg font-extrabold">
                    {{$value['variationName']}}<span class="ml-2  @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif  text-xs">{{$value['variationType']}}</span></div>   

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
                                    <input class="form-check-input" id="{{$item->id}}" data-price_additional="{{$item->price}}" value="{{$item->id}}" name="items[]" type="checkbox">
                                    <label class="form-check-label" for="{{$item->id}}" style="cursor: pointer">{{$item->name}}</label>
                                </div>
                               <div class="additional_price">R$ {{$item->price}}</div>
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
        <h1 class="text-xl sm:text-2xl font-bold text-black-600 my-3">@if(@count($product['product']->variations) > 0 || $product['product']->price != null )Valor/Quantidade @else Informe o valor e quantidade desejada @endif</h1>
        <div class="alert alert-info alert-dismissible fade show @if(@count($product['product']->variations) > 0   || $product['product']->price != null) d-none @endif" role="alert">
            <strong>Aviso</strong> Esse produto não tem variação, necessário especificar o valor desejado. Obrigado !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
        <div class="price-product flex">
            <p class="font-bold mr-2">R$</p>
            @if(@count($product['product']->variations) > 0)
                <div class="price-product-selected">
                    {{$maxValue['variationPrice']}}
                </div>
            @else
                <input type="number" @if($product['product']->price != null) readonly @endif name="priceCliente" class="outline-none w-[120px]" placeholder="Ex: 30.00" value="{{$product['product']->price}}">
            
            @endif
            <div class="product-content-info--qtarea flex items-center  h-[30px] rounded-[10px] px-[10px]">
                <button class="product-content-info--qtmenos  px-[10px] text-lg  @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif font-bold rounded-lg">-</button>
                <div class="product-content-info--qt mx-3 font-bold">1</div>
                <button class="product-content-info--qtmais px-[10px] text-lg  @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif font-bold rounded-lg">+</button>

            </div>
        </div>
        
    </div>
    @if(@count($additional->items) > 0)
        <div class="content-value-price-additional mr-3 ml-3 mb-3 my-3 text-xl sm:text-1xl">
            <h3 class="font-bold ">Valor dos Adicionais</h3>
            <section class="flex mt-2">
                <p class="font-bold mr-2">R$</p> <div class="price_additional">0,00</div>
            </section>
            <div class="flex my-2 text-black font-bold">
                <Strong>Valor Total R$</Strong> <div class="final-price ml-2"> 0,00</div>
            </div>
        </div>
    @endif
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
        <div class="product-content-add-cart mr-3 ml-3 my-4 flex items-center ">
            @if($product['company'][0]->status)
                <div class="add-cart bg-green-300 text-green-600 font-bold p-2 rounded-xl mr-4 cursor-pointer" data-product_id="{{$product['product']->id}}" data-company_id="{{$product['company'][0]->id}}">Adicionar ao Carrinho</div>
            @endif
            <div  data-back-home="/app/menu/{{$product['company']['settings'][0]->slug_url}}" class="closed-modal flex @if($product['company']['settings'][0]->secondColor != null) bg-[{{$product['company']['settings'][0]->secondColor}}] @else  bg-orange-300 @endif @if($product['company']['settings'][0]->primaryColor != null) text-[{{$product['company']['settings'][0]->primaryColor}}] @else  text-orange-600 @endif font-bold p-2 rounded-xl cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
                Voltar
            </div>
        </div>
    </div>
    
</div>
    <script src="{{url('site/js/axiosJS/axios.js')}}"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{url('theme-sdb-admin-2/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/js/sb-admin-2.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{url('theme-sdb-admin-2/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{url('site/js/home.js')}}"></script>
    <script src="{{url('site/js/checkout.js')}}"></script>
    <script src="{{url('panel/js/ultils.js')}}"></script>
    <script src="{{url('site/js/wolcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{url('site/js/wolcarousel/owl.theme.default.min.js')}}"></script>
    <script src="{{url('theme-sdb-admin-2/vendor/sweetalert2/sweetalert.all.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    {{-- // <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script> --}}
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script >
        Home.constructor()
        const items  = [];
        const options = {
            activeItemPosition: 1,
            interval: 6000,
            indicators: {
                activeClasses: 'bg-white dark:bg-gray-800',
                inactiveClasses: 'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
                items: []
            }
        };
        $(".content-slide" ).each(function( index ) {
            items.push({
                position: index,
                el: document.getElementById('carousel-item-'+index)
            })
            options.indicators.items.push({
                position: index,
                el: document.getElementById('carousel-indicator-'+index)
            })
        });
    
        const carousel = new Carousel(items, options);
        const prevButton = document.getElementById('data-carousel-prev');
        const nextButton = document.getElementById('data-carousel-next');
    
        prevButton.addEventListener('click', () => {
            carousel.prev();
        });
    
        nextButton.addEventListener('click', () => {
            carousel.next();
        });
    </script>
</body>

</html>