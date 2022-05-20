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
        <div class="container mx-auto h-[50px] flex items-center">
            <h1 class="ml-[20px] ms:ml-[0px]  @if(@count($menuCompany['company']['settings']) > 0) text-[{{$menuCompany['company']['settings']->bgColor}}] @else text-black @endif font-medium text-xl
            ">Cardapio</h1>
        </div>
    </section>
    @if($menuCompany['company']['settings']->hasOpeneed == 0)
        <div class="bg-red-500 text-center my-4 p-5 text-white" role="alert">
            <strong>Aviso </strong>Essa loja encorou o expediente por hoje, mas fique tranquilo os seus pedidos serão salvos e poderão ser preparado e entregues amanhã.
        </div>
    @endif
    <section class="w-full h-full">
        <div class="container mx-auto">
            @yield('content-page')
        </div>
    </section>
    <!-- include footer -->
   @include('layouts.include.app.footer')
</body>
</html>