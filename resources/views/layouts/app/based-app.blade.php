<!DOCTYPE html>
<html lang="pt-br">
{{-- Inclde head --}}
@include('layouts.include.app.head')
<body id="page-top">
     <!-- init header -->
     <header class="header w-full h-[320px] sm:flex sm:items-center flex items-center border border-b-3 bg-white bg-cover bg-no-repeat bg-top " @if(@count($menuCompany['company']['settings']['banner']) > 0) style="background-image: url('/profile/{{$menuCompany['company']['settings']['banner'][0]->path}}')" @else 
            style="background-image: url('/site/images/default/banner-default.jpg')"
        @endif>
        <!-- container-page -->
        <div class="w-full h-full mx-auto flex justify-center items-center" style="background-image: radial-gradient(hsl(0deg 0% 0% / 62%), transparent)">
            <div class="conten-ifon-company flex flex-col items-center">
                <img src="@if(@count($menuCompany['company']['settings']['pictureProfile']) > 0) /profile/{{$menuCompany['company']['settings']['pictureProfile'][0]->path}} @else /site/images/default/logo-default.jpg @endif " alt="" width="150px" height="150px" class="rounded-full">
                <div class="name-comapny mt-3 text-white font-medium text-4xl uppercase"><h4>{{$menuCompany['company']->name}}</h4></div>

                <div class="name-comapny mt-3 text-white font-medium text-1xl flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16" >
                    <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                    <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                  </svg>
                  <p class="ml-2 uppercase ">
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
            {{-- <h1 class="ml-[20px] ms:ml-[0px]  @if(@count($menuCompany['company']['settings']) > 0) text-[{{$menuCompany['company']['settings']->bgColor}}] @else text-black @endif font-medium text-xl
            ">Cardapio {{ Cart::getTotalQuantity()}} --}}
            <section class="text-orange-600 text-2xl">
                <header class="flex items-center justify-center sm:text-2xl font-bold text-gray-900">    
                    <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt="" width="70px"><p class="hidden sm:block ml-2">CbFood.</p>
                </header>
            </section>
           
            <div class="content-alert-bar-menu flex">
                @if (!Auth::guest())
                    
                
                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle flex items-center mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p class="mr-2">Olá {{Auth::user()->name}}</p>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                          <button class="dropdown-item my-bag">Minha Sacola</button>
                          <button class="dropdown-item logout-user" >Sair</button>
                        </div>
                      </div>
                @else
                    <a href="#" class="show-modal-login-user mr-2" type="button" style="text-decoration:none">Login</a>
                    <a href="#" class="mx-3 hidden" type="button" style="text-decoration:none">Cadastre-se</a>
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
    @if($menuCompany['company']['settings']->hasOpeneed == 0)
        <div class="mx-auto w-[80%] mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Aviso !</strong> Essa loja encorou o expediente por hoje, mas fique tranquilo os seus pedidos serão salvos e poderão ser preparado e entregues amanhã.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
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