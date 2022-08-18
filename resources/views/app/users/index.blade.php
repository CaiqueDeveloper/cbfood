@if(!Auth::user())
<header class="flex items-center justify-center sm:text-3xl font-bold text-gray-900">    
    <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt="">
</header>
<h1 class="text-center text-gray-900 font-bold text-3xl my-3">Entrar</h1>
<form class="needs-validation form-login-user" >
    <div class="font-bold text-gray-900">
        <div class="col mb-3">
            <label for="firstName">WhatApp</label>
            <input type="text" class="form-control phone_number" name="number_phone" required>
        </div>
    </div>
    <div class="font-bold text-gray-900">
        <label for="username">Senha</label>
        <div class="input-group col">
            <input type="password" class="form-control"  name="password" required>
        </div>
    </div>
   
    <button class="w-full mt-4 bg-orange-300 text-orange-600 font-bold p-2 rounded-xl text-lg" type="submit">Entrar</button>
    </div>
</form>
@else
    <article class="flex justify-between">
        <p class="text-black font-bold text-xl">Óla {{Auth::user()->name}}</p>
        <p class="mr-4 font-bold text-red-600 logout-user cursor-pointer">Sair</p>
    </article>
@endif