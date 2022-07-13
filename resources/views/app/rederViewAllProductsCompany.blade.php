@php
    //dd($menuCompany['company']['settings'])
@endphp
@forelse ($menuCompany['company']['products'] as $product)
@php
//dd($product);
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
        <div class="item-announcement-footer-price  hover:text-orange-600 text-sm font-bold">{{$product->name}} <p class="text-sm bg-orange-300 text-orange-600 rounded-full hidden">{{$product->category->name}}</p></div>
        <div class="item-announcement-footer-add-cart animate-bounce  hover:text-orange-600"><i class="fa fa-cart-plus"></i></div>
    </div>
</div>
@empty
<h2>Ops ! A Empresa inda não cadastrou seus produtos</h2>    
@endforelse 