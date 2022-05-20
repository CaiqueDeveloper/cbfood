@extends('layouts.app.based-app')
@section('title', $menuCompany['company']->name)
@section('content-page')


<div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-[50px]">
    <div class="content sm:col-span-2">
        <!-- init section filters -->
        <div class="sm:col-span-2 sm:h-[150px] h-[250px] border-solid border-2 shadow-md rounded-md flex flex-col items-center justify-center  hidden">
            <div class="w-full header-filter flex justify-between">
                <h1 class="text-black-700 text-[16px] font-bold ml-[30px]">Filters</h1>
                <h1 class="text-orange-700 text-[12px] font-medium mr-[30px]">Reset Filters</h1>
            </div>
            <div class="w-full body-filter flex flex-col sm:flex-row mt-[20px] sm:mt-[-30px] items-center sm:justify-between">
                <select name="select " class="w-[95vw] sm:w-[25vw] mb-[30px] sm:-mb-[0px] h-[50px] sm:ml-[20px] sm:mt-[40px] rounded-lg" style="border: 1px solid #ddd;">
                    <option value="valor1">Valor 1</option>
                    <option value="valor2" selected>Valor 2</option>
                    <option value="valor3">Valor 3</option>
                    </select>

                <input name="select " class="w-[95vw] sm:w-[25vw] h-[50px] sm:mr-[20px] sm:mt-[40px] rounded-lg" style="border: 1px solid #ddd;"></input>
            </div>
        </div>
        <!-- final section filters -->
        <!-- init section conte-body page -->
        <div class="content-body w-full colaps-2 my-[20px]">
            <div class="model hidden">
                {{-- Model Announcemente item --}}
                <div class="item-announcement w-full min-h-[250px] flex flex-col-reverse relative shadow-lg cursor-pointer my-[5px] overflow-hidden sm:rounded-3xl">
                    <a href="#">
                        <div class="item-announcement-body absolute w-full h-full top-0 left-0 bg-cover bg-no-repeat bg-center z-1 mb-[20px] hover:scale-[1.2] transition duration-700">
                        </div>
                    </a>
                    <div class="item-announcement-description justify-between sm:mx-10 mx-3 text-white font-bold items-center mt-[150px] absolute z-30 top-0 w-full">
                        <div class="item-announcement-description-name drop-shadow-3xl"><p>---</p></div>
                        <div class="item-announcement-more-info drop-shadow-3xl"><p>-----</p></div>
                    </div>
                    <div class="item-announcement-footer w-full h-[60px] bg-white z-10 flex items-center justify-between sm:px-10 px-3 text-lg">
                        <div class="item-announcement-footer-price hover:text-orange-600">R$ --------</div>
                        <div class="item-announcement-footer-add-cart hover:text-orange-600"><i class="fa fa-cart-plus"></i></div>
                    </div>
                </div>
                
            </div>
            
            {{-- modal more info announcement --}}
            <div class="content-modal-view-product"></div>
           
            <div class="grid grid-cols-1 gap-1 sm:grid-cols-4  sm:gap-2 announcement-area relative">
                
                @forelse ($menuCompany['company']['products'] as $product)
                    @php
                        $first_date = new DateTime($product->created_at);
                        $now = new DateTime();
                        $difference = $first_date->diff($now)->days;
                    @endphp
                    <div class="item-announcement w-full min-h-[250px] flex flex-col-reverse relative shadow-lg cursor-pointer my-[5px] overflow-hidden sm:rounded-3xl">
                        <div class="absolute bg-green-300 z-50 top-2 left-2 text-green-600 font-bold rounded-md px-1  @if($difference > 5)  hidden @endif">
                            novo
                        </div>
                        <div class="absolute bg-yellow-300 z-50 top-2 left-2 text-yellow-600 font-bold rounded-md px-1 @if(!@isset($product->hasPromotion) && $product->hasPromotion != 1) hidden @endif">
                            promoção
                        </div>
                        <a href="#" class="getModalProduct" value="{{$product->id}}">
                            <div class="item-announcement-body absolute w-full h-full top-0 left-0 bg-cover bg-no-repeat bg-center z-1 mb-[20px] hover:scale-[1.2] transition duration-700" style="background-image: url('/product_photo/{{$product->images->last()->path}}')">
                            </div>
                        </a>
                        <div class="item-announcement-description justify-between sm:mx-10 mx-3 text-white font-bold items-center mt-[150px] absolute z-30 top-0 w-full">
                            <div class="item-announcement-description-name drop-shadow-3xl hidden"><p>{{$product->name}} </p></div>
                            <div class="item-announcement-more-info drop-shadow-3xl hidden"><p>{{$product->description}}</p></div>
                        </div>
                        <div class="item-announcement-footer w-full h-[60px] bg-white z-10 flex items-center justify-between sm:px-10 px-3 text-lg">
                            <div class="item-announcement-footer-price @if(@count($menuCompany['company']['settings']) > 0) hover:text-[{{$menuCompany['company']['settings']->bgColor}}] @else  hover:text-orange-600 @endif text-sm font-bold">{{$product->name}} <p class="text-sm bg-orange-300 text-orange-600 rounded-full hidden">{{$product->category->name}}</p></div>
                            <div class="item-announcement-footer-add-cart animate-bounce   @if(@count($menuCompany['company']['settings']) > 0) hover:text-[{{$menuCompany['company']['settings']->bgColor}}] @else hover:text-orange-600 @endif"><i class="fa fa-cart-plus"></i></div>
                        </div>
                    </div>
                @empty
                    <h2>Ops ! A Empresa inda não cadastrou seus produtos</h2>    
                @endforelse 
            </div>

        </div>
        <!-- final section conte-body page -->
    </div>

    <!-- int section payment -->
    <div class="content-section-payment  w-full bg-white ">
        <div class="min-h-[250px] border-solid border-2 shadow-md rounded-lg bg-white ">
            <div class="payment-header h-[60px] bg-black rounded-tl-md rounded-tr-md flex items-center">
                <h1 class="text-white ml-[25px] font-bold">Carrinho</h1>
            </div>
            <div class="payment-body w-full min-h-[50px] sm:w-[450px] px-[30px] flex flex-col  h-full my-[30px] ">
               <div class="item-cart grid grid-cols-1 gap-1 sm:grid-cols-3 sm:gap-3 mb-3">
                    <div class="item-cart-image  bg-orange-300 min-h-[80px] flex items-center justify-center rounded-lg"> <i class="fa fa-cart-plus text-orange-600 text-3xl"></i></div>
                    <div class="item-cart-title flex flex-col items-left my-3">
                        <strong class="text-sm mb-2">Seu carrinho está vazio</strong>
                        <small class="text-[10px]">Comece a adicionar itens</small>
                    </div>
                    <div class="item-cart-price text-left sm:text-right mt-2"><strong class="text-sm mr-2">Valor: </strong>R$ 0,00</div>
               </div>
               {{-- final cart intem --}}
               <div class="delivery-fee w-full border-dashed border-y-2 border-gay-600 py-3 flex justify-between my-[20px]">
                    <div>
                        <input  type="radio" id="delivery" name="drone" value="2.00" checked class="checked:bg-orange-500">
                        <label for="huey"  class="text-gray-700">Entrega</label>
                    </div>
                    <p>R$ 2,00</p>
               </div>
               <div class="payment-footer flex justify-center ">
                <button class="w-full sm:w-[450px] h-[40px]  rounded-lg text-white font-medium bg-gradient-to-r from-orange-300 to-orange-600 hover:from-orange-600 hover:to-orange-300 transition delay-150 duration-300 ease-in-out sm:animate-bounce">Finalizar Pedido</button>
            </div>
            </div>
            
        </div>
    </div>
    <!-- fianl section payment -->
</div>
@endsection