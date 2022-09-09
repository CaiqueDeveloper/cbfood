@if(!Auth::user())
<header class="flex items-center justify-center sm:text-3xl font-bold text-gray-900">    
    <img src="@if(@count($company['company']['settings']['pictureProfile']) > 0) /profile/{{$company['company']['settings']['pictureProfile'][0]->path}} @else /profile/default/logo-food-demo.webp @endif " alt="" width="150px" height="150px" class="rounded-full">
</header>
<div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 alert hidden mr-3" role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <span class="sr-only">Erro !</span>
    <div>
      <span class="font-medium"></span> Número de telefone e/ou senha invalido.
    </div>
  </div>
<form class="form-login-user mr-3">
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 font-bold">WhatApp</label>
      <input type="text" name="number_phone" id="email" class="phone bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required="">
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 font-bold">Senha</label>
      <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
    {{-- <div class="flex items-start mb-6">
      <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
      </div>
      <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
    </div> --}}
    <button type="submit" class="font-bold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center @if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif ">Entrar</button>
</form>

@else
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
      <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="tabExample" role="tablist">
          <li class="mr-2" role="presentation">
              <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="profile-tab-example" type="button" role="tab" aria-controls="profile-example" aria-selected="true">Perfil</button>
          </li>
          <li class="mr-2" role="presentation">
              <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab-example" type="button" role="tab" aria-controls="dashboard-example" aria-selected="false">Endereço</button>
          </li>
          <li class="mr-2" role="presentation">
              <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab-example" type="button" role="tab" aria-controls="settings-example" aria-selected="false">Segurança</button>
          </li>
      </ul>
  </div>
  <div id="tabContentExample" class="ml-[-5%] px-1">
      <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile-example" role="tabpanel" aria-labelledby="profile-tab-example">
         
        <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 ">
            <section class="flex justify-between mb-3">
                <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600">
                    <svg class="absolute -left-1 w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <svg class="logout-user w-10 h-10 rounded-full cursor-pointer @if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </section>
          <a href="#">
              <h5 class="my-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Óla {{Auth::user()->name}}</h5>
          </a>
              <form action="" class="user-folks">
                <div class="form_container">
                  <div class="row font-bold text-gray-900">
                      <div class="col-md-6 mb-3">
                          <label for="firstName">Nome</label>
                          <input type="text" value="{{Auth::user()->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required="" name="name" id="firstName" required>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="lastName">WhatApp</label>
                          <input type="text" value="{{Auth::user()->number_phone}}"  class="phone bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required="phone_number" id="lastName" name="number_phone" required>
                      </div>
                  </div>
                  <div class="mb-3 font-bold text-gray-900">
                      <label for="username">E-mail (Opicional)</label>
                      <div class="input-group">
                          <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="username" value="{{Auth::user()->email}}"  name="email" >
                      </div>
                  </div>
                  <button type="submit" class="font-bold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center @if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif ">Editar</button>
                </div>
              </form>
        </div>

      </div>
      <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard-example" role="tabpanel" aria-labelledby="dashboard-tab-example">
        <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 ">
            <section class="flex justify-between mb-3 ">
                <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600 flex justify-center items-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    
                </div>
                <svg class="logout-user w-10 h-10 rounded-full hidden cursor-pointer @if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </section>
            <a href="#">
                <h5 class="my-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Endereço</h5>
            </a>
            @foreach(Auth::user()->address as $addres)
                <div class="custom-control custom-radio shadow py-3 my-3 rounded-2xl cursor-pointer">
                    <input id="{{$addres->id}}" name="address" type="checkbox" class="custom-control-input ml-3 cursor-pointer z-40" value="{{$addres->id}}">
                    <label class="custom-control-label ml-3 cursor-pointer z-40" for="{{$addres->id}}">Rua {{$addres->road}}, Nª {{$addres->number}}, Bairro {{$addres->distric}}, Cidade {{$addres->city}}/{{$addres->states}}...</label>
                </div>
            @endforeach
        </div>
      </div>
      <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="settings-example" role="tabpanel" aria-labelledby="settings-tab-example">
        <div class="p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 ">
            <section class="flex justify-between mb-3 hidden">
                <div class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600">
                    <svg class="absolute -left-1 w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <svg class="logout-user w-10 h-10 rounded-full cursor-pointer @if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </section>
            <a href="#">
                <h5 class="my-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Trocar Senha</h5>
            </a>
            <form class="user-change-password" method="POST">
                <!-- Form Group (username)-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (phone number)-->
                    <div class="col">
                        <label class="small mb-1" for="inputPhone">Senha</label>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"id="inputPhone" type="password" name="password" value="$2y$10$Pa6W6.O1nHLiKyYV3g86bOzK5GDr0tqgh1FvsxTMgSTFJjRMyqQw2">
                    </div>
                </div>
                <!-- Form Group (email address)-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (phone number)-->
                    <div class="col">
                        <label class="small mb-1" for="inputPhone">Confirmação da Senha</label>
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"id="inputPhone" type="password" name="password_confirmation" value="$2y$10$Pa6W6.O1nHLiKyYV3g86bOzK5GDr0tqgh1FvsxTMgSTFJjRMyqQw2">
                    </div>
                </div>
                <!-- Save changes button-->
                <button type="submit" class="font-bold rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center @if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif ">Editar</button>
            </form>
        </div>
      </div>
      <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="contacts-example" role="tabpanel" aria-labelledby="contacts-tab-example">
           
      </div>
  </div>
  

@endif
<script>
    Ultils.filters_golbal()
    
    // create an array of objects with the id, trigger element (eg. button), and the content element
    const tabElements = [
        {
            id: 'profile',
            triggerEl: document.querySelector('#profile-tab-example'),
            targetEl: document.querySelector('#profile-example')
        },
        {
            id: 'dashboard',
            triggerEl: document.querySelector('#dashboard-tab-example'),
            targetEl: document.querySelector('#dashboard-example')
        },
        {
            id: 'settings',
            triggerEl: document.querySelector('#settings-tab-example'),
            targetEl: document.querySelector('#settings-example')
        },
    ];
    // options with default values
    const options = {
        defaultTabId: 'profile',
        activeClasses: 'text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-400 border-blue-600 dark:border-blue-500',
        inactiveClasses: 'text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300',
        onShow: () => {
            console.log('tab is shown');
        }
    };
    const tabs = new Tabs(tabElements, options);

</script>