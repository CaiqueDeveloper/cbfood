<header class="flex items-center justify-center sm:text-4xl font-bold text-gray-900">    
    <img src="{{ url('panel/img/logo/icon-page.svg') }}" alt=""><p>CbFood.</p>
</header>
<h1 class="text-center text-gray-900 font-bold text-4xl my-3">Login</h1>
<form class="needs-validation form-login-user" >
    <div class="row font-bold text-gray-900">
        <div class="col mb-3">
            <label for="firstName">WhatApp</label>
            <input type="text" class="form-control phone_number" name="number_phone" required>
        </div>
    </div>
    <div class="mb-3 font-bold text-gray-900">
        <label for="username">Senha</label>
        <div class="input-group">
            <input type="password" class="form-control"  name="password" required>
        </div>
    </div>
   
    <hr class="mb-4">
    <button class="bg-orange-300 text-orange-600 font-bold p-2 rounded-xl text-lg" type="submit">Entrar</button>
    </div>
</form>