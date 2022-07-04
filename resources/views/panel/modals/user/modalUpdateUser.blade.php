<form class="user-folks">
    <!-- Form Group (username)-->
    <div class="mb-3">
        <label class="small mb-1" for="inputUsername">Nome</label>
        <input class="form-control" id="inputUsername" type="text" name="name" placeholder="Enter your username" value="{{$user->name}}">
    </div>
    <!-- Form Group (email address)-->
    <div class="mb-3">
        <label class="small mb-1" for="inputEmailAddress">Email</label>
        <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="{{$user->email}}">
    </div>
    <!-- Form Row-->
    <div class="row gx-3 mb-3">
        <!-- Form Group (phone number)-->
        <div class="col-md-6">
            <label class="small mb-1" for="inputPhone">Número de Telefone</label>
            <input class="form-control" id="inputPhone" type="tel" name="number_phone"placeholder="Enter your phone number" value="{{$user->number_phone}}">
        </div>
        <!-- Form Group (birthday)-->
        <div class="col-md-6">
            <label class="small mb-1" for="inputBirthday">Número de Telefone Alternativo</label>
            <input class="form-control" id="inputBirthday" type="text" name="number_phone_alternative" placeholder="Enter your birthday" value="{{$user->number_phone_alternative}}">
        </div>
    </div>
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <!-- Save changes button-->
    <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
</form>