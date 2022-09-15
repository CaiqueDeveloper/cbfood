@php
    //dd($menuCompany['company']['settings'])
@endphp
<div class="grid grid-cols-1 gap-1 sm:grid-cols-4  sm:gap-2 py-4">
@forelse ($menuCompany['company']['products'] as $product)
@php
    $first_date = new DateTime($product->created_at);
    $now = new DateTime();
    $difference = $first_date->diff($now)->days;
@endphp
<a href="{{route('product',['id' =>$product->id])}} " style="text-decoration: none" class="hover:text-gray-600">
<section class="cart-item-model relative mt-3 mr-3 shadow my-3 sm:mr-3 sm:ml-3 p-2 min-h-[250px] cursor-pointer rounded-xl" value="{{$product->id}}"  >
    {{-- @if($difference < 5)
        <div class="absolute bg-green-300 z-50 top-2 left-2 text-green-600 font-bold rounded-md px-1">
            novo
        </div>
        @endif
        @if($product->promotion)
            @if($product->promotion[0]->periodStart <= $now->format('Y-m-d') && $product->promotion[0]->periodEnd >= $now->format('Y-m-d'))
                <div class="absolute bg-yellow-300 z-50 top-2 left-2 text-yellow-600 font-bold rounded-md px-1 animate-bounce">
                    promoção
                </div>
            @endif
    @endif --}}
    <div class="content-info-product grid sm:grid-cols-2 col-span-2 min-h-[200px]">
        <section>
            <div class="title-product text-black font-bold text-sm mb-2">{{$product->name}}</div>
            <div class="title-product  font-bold text-sm">
                @if($product->description != null)
                    {{$product->description}}
                @else
                    Não temos mais informações disponível sobre esse produto
                @endif
            </div>
        </section>
        <section class="bg-cover bg-no-repeat bg-center" style="background-image: url('/product_photo/@if(@count($product->images->last()->path) > 0){{$product->images->last()->path}}@else/default/default.jpg @endif ')" ></section>
    </div>
    <div class="footer-content-product mt-3 flex  justify-bettwee">
        {{-- <section class="font-bold text-green-600">
            R$ {{number_format($product->price,2,",",".")}}
        </section> --}}
        <section>
            
        </section>
        <section>
        </section>
    </div>
</section>
</a>
    {{-- <a href="{{route('product',['id' =>$product->id])}} " style="text-decoration: none" class="hover:text-gray-600">
        <div class="item-announcement w-full min-h-[250px] flex flex-col-reverse relative shadow-lg cursor-pointer my-[5px] overflow-hidden sm:rounded-3xl">
           
            <a href="#" class="getModalProduct" value="{{$product->id}}">
                <div class="item-announcement-body absolute w-full h-full top-0 left-0 bg-cover bg-no-repeat bg-center z-1 mb-[20px] hover:scale-[1.2] transition duration-700" style="background-image: url('/product_photo/@if(@count($product->images->last()->path) > 0){{$product->images->last()->path}}@else/default/default.jpg @endif ')">
                </div>
            </a>
            <div class="item-announcement-description justify-between sm:mx-10 mx-3 text-white font-bold items-center mt-[150px] absolute z-30 top-0 w-full">
                <div class="item-announcement-description-name drop-shadow-3xl hidden"><p>{{$product->name}} </p></div>
                <div class="item-announcement-more-info drop-shadow-3xl hidden"><p>{{$product->description}}</p></div>
            </div>
            <div class="item-announcement-footer w-full h-[60px] bg-white z-10 flex items-center justify-between sm:px-10 px-3 text-lg">
                <div class="item-announcement-footer-price  hover:text-orange-600 text-sm font-bold">{{$product->name}} <p class="text-sm bg-orange-300 text-orange-600 rounded-full hidden">{{$product->category->name}}</p></div>
                <div class="item-announcement-footer-add-cart animate-bounce  hover:text-orange-600 add-cart"><i class="fa fa-cart-plus"></i></div>
            </div>
        </div>  
    </a> --}}


@empty  
@endforelse 
</div>
<div id="pagination" class="my-3">
    {!!$menuCompany['company']['products']->links()!!}
</div>
<script>
    $("#pagination > nav  a").on('click', function(e){
            e.preventDefault()
            var page = $(this).attr('href').split('page=')[1];
            $(this).attr('href').split('page=')[1]+1
            Home.rederViewAllProductsCompany(page)
        })
</script>