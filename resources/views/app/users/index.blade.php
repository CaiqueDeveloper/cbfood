@if(!Auth::user())
<header class="flex items-center justify-center sm:text-3xl font-bold text-gray-900">    
    <img src="@if(@count($menuCompany['company']['settings']['pictureProfile']) > 0) /profile/{{$menuCompany['company']['settings']['pictureProfile'][0]->path}} @else /profile/default/logo-food-demo.webp @endif " alt="" width="150px" height="150px" class="rounded-full">
</header>

<form class="form-login-user mr-3">
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">WhatApp Number</label>
      <input type="text" name="number_phone" id="email" class="phone bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"required="">
    </div>
    <div class="mb-6">
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Senha</label>
      <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
    </div>
    {{-- <div class="flex items-start mb-6">
      <div class="flex items-center h-5">
        <input id="remember" type="checkbox" value="" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
      </div>
      <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
    </div> --}}
    <button type="submit" class="@if($company['company']->settings[0]->secondColor != null) bg-[{{$company['company']->settings[0]->secondColor}}] @else  bg-orange-300 @endif @if($company['company']->settings[0]->primaryColor != null) text-[{{$company['company']->settings[0]->primaryColor}}] @else  text-orange-600 @endif bg-orange-300 text-orange-600 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Entrar</button>
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