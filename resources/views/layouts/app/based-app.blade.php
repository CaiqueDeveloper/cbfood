<!DOCTYPE html>
<html lang="pt-br">
{{-- Inclde head --}}
@include('layouts.include.app.head')
<body id="page-top">
     <!-- init header -->
    
     <header class="header w-full h-[320px] sm:flex sm:items-center flex items-center border border-b-3 bg-white bg-cover bg-no-repeat bg-top " @if(@count($menuCompany['company']['settings']['banner']) > 0) style="background-image: url('/profile/{{$menuCompany['company']['settings']['banner'][0]->path}}')" @else 
            style="background-image: url('/profile/default/banner-food-demo.jpg')"
        @endif>
        
        <!-- container-page -->
        <div class="w-full h-full mx-auto flex justify-center items-center" style="background-image: radial-gradient(hsl(0deg 0% 0% / 62%), transparent)">
            <div class="conten-ifon-company flex flex-col items-center">
                <img src="@if(@count($menuCompany['company']['settings']['pictureProfile']) > 0) /profile/{{$menuCompany['company']['settings']['pictureProfile'][0]->path}} @else /profile/default/logo-food-demo.webp @endif " alt="" width="150px" height="150px" class="rounded-full">
                <div class="name-comapny mt-3 text-white font-medium text-4xl uppercase text-center"><h4>{{$menuCompany['company']->name}}</h4></div>

                <div class="name-comapny mt-3 text-white font-medium text-1xl flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill hidden sm:flex" viewBox="0 0 16 16" >
                    <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                    <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                  </svg>
                  <p class="ml-2 uppercase text-center">
                    @if(@count($menuCompany['company']['address']) > 0) 
                        {{$menuCompany['company']['address'][0]->road}}, {{$menuCompany['company']['address'][0]->number}}, {{$menuCompany['company']['address'][0]->distric}}, {{$menuCompany['company']['address'][0]->city}}/{{$menuCompany['company']['address'][0]->states}}...
                    @else
                        Essa empresa ainda não cadastrou um endereço... 
                    @endif
                </p>
            </div>
            </div>
        </div>
    </header>
    <!-- finish header -->
    <section class="bar-alert w-full h-[50px] shadow-lg">
        <div class="container mx-auto h-[50px] flex items-center justify-between font-bold text-gray-600">
            <section class="text-orange-600 text-2xl">
                <header class="flex items-center justify-center sm:text-2xl font-bold text-gray-900">    
                    <img src="@if(@count($menuCompany['company']['settings']['pictureProfile']) > 0) /profile/{{$menuCompany['company']['settings']['pictureProfile'][0]->path}} @else /profile/default/logo-food-demo.webp @endif " alt="" width="70px" height="70px" class="rounded-full"><p class=" ml-2 text-sm sm:text-md">{{$menuCompany['company']->name}}</p>
                </header>
            </section>
           
            <div class="content-alert-bar-menu flex hidden">
                @if (!Auth::guest())
                    
                
                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle flex items-center mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p class="mr-2">Olá {{Auth::user()->name}}</p>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <button class="dropdown-item my-bag hidden">Minha Sacola</button>
                          <button class="dropdown-item logout-user" >Sair</button>
                        </div>
                      </div>
                      <a href="#" class="my-bag mr-3 text-orange-600 hove:text-orange-600 active:text-orange-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
                          </svg>
                        </a>
                @else
                    <a href="#" class="show-modal-login-user mr-2" type="button" style="text-decoration:none">Login</a>
                  
                @endif
               
                <a href="#" class="relative hidden sm:block open-shopping-cart">
                    <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                     </svg>
                     <div class="total-itemCart absolute top-[-17px] right-[-5px] text-bold">
                        {{ @count(Cart::getContent())}}
                     </div>
                </a>
            </div>
        </h1>
        </div>
       
    </section>
   
    <div class="mx-auto w-[78%] mt-4 flex justify-end">
        <article class="flex items-center font-bold @if($menuCompany['company']->settings[0]->secondColor != null) text-[{{$menuCompany['company']->settings[0]->secondColor}}] @else text-orange-600 @endif">
            <p class="mr-3">Fale Conosco</p>
            <p>
                <a href="https://api.whatsapp.com/send?phone={{preg_replace( '/[^0-9]/','',$menuCompany['company']->phone_number)}}&text=Óla ! Vim pelo site."  class="btn btn-success" target="_blank">
                    <i class="bi bi-whatsapp"></i>
                </a>
            </p>
        </article>
    </div>
    @if($menuCompany['company']['settings'][0]['hasOpeneed'] == 0)
    <div class="mx-auto w-[78%] mt-4">
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Aviso</p>
            <p>Essa loja encorou o expediente por hoje, mas fique tranquilo os seus pedidos serão salvos e poderão ser preparado e entregues amanhã.</p>
          </div>
    </div>
    @endif
    @if($menuCompany['company']['settings'][0]['hasDelivery'] == 0)
        <div class="mx-auto w-[78%] mt-4">
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                <p class="font-bold">Informativo</p>
                <p class="text-sm">Desculpe mas não estamos com o delivery disponível hoje, somente retirada na nossa loja</p>
            </div>
        </div>
    @endif
    @if($menuCompany['company']['settings'][0]['limit_send_delivery'] != null)
        <div class="mx-auto w-[78%] mt-4">
            <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
                <p class="font-bold">Informativo</p>
                <p class="text-sm">O Delivery só estará disponível em compras a partir de <strong>R$ {{$menuCompany['company']['settings'][0]['limit_send_delivery']}}</strong>. Compras com valor menor do que  o informado será necessário retirar pessoalmente no local.</p>
            </div>
        </div>
      @endif
      
    <section class="w-full h-full">
        <div class="container mx-auto mb-3">
            @yield('content-page')
        </div>
    </section>
    <!-- include footer -->
   @include('layouts.include.app.footer')
</body>
</html>