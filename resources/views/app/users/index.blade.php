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
    <article class="flex justify-between">
        <p class="text-black font-bold text-xl">Óla {{Auth::user()->name}}</p>
        <p class="mr-4 font-bold text-red-600 logout-user cursor-pointer">Sair</p>
    </article>
@endif
<script>
    Ultils.filters_golbal()
</script>