@extends('layouts.app.based-app')
@section('title', $menuCompany['company']->name)
@section('content-page')


<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-[50px]">
    <div class="content sm:col-span-3">
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
        {{-- section reder view products --}}
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
</div>
@endsection