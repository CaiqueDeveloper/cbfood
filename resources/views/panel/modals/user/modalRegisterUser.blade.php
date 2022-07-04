<form class="form-storage-user">
    <!-- Form Group (username)-->
    <div class="mb-3 col-md-6" style="margin-left: -10px">
        <label class="small mb-1" for="inputPhone">Perfil do Usuário</label>
        <select class="custom-select  mb-3" name="profile">
            @foreach($profiles as $profile)
                <option value="{{$profile->id}}">{{$profile->label}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="small mb-1" for="inputUsername">Nome</label>
        <input class="form-control" id="inputUsername" type="text" name="name" value="">
    </div>
    <!-- Form Group (email address)-->
    <div class="mb-3">
        <label class="small mb-1" for="inputEmailAddress">Email</label>
        <input class="form-control" id="inputEmailAddress" type="email" name="email" value="">
    </div>
    <!-- Form Row-->
    <div class="row gx-3 mb-3">
        <!-- Form Group (phone number)-->
        <div class="col-md-6">
            <label class="small mb-1" for="inputPhone">Número de Telefone</label>
            <input class="form-control" id="inputPhone" type="tel" name="number_phone" value="">
        </div>
        <!-- Form Group (birthday)-->
        <div class="col-md-6">
            <label class="small mb-1" for="inputBirthday">Número de Telefone Alternativo</label>
            <input class="form-control" id="inputBirthday" type="text" name="number_phone_alternative" value="">
        </div>
    </div>
    <div class="row gx-3 mb-3">
        <!-- Form Group (phone number)-->
        <div class="col-md-6">
            <label class="small mb-1" for="inputPhone">Senha</label>
            <input class="form-control" id="inputPhone" type="password" name="password" value="">
        </div>
        <!-- Form Group (birthday)-->
        <div class="col-md-6">
            <label class="small mb-1" for="inputBirthday">Confirme a sua senha</label>
            <input class="form-control" id="inputBirthday" type="password" name="password_confirmation" value="">
        </div>
    </div>
    <!-- Save changes button-->
    <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
</form>