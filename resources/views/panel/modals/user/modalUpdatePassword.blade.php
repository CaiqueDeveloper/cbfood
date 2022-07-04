<div class="row">
    <div class="col">
        <form class="user-change-password" method="POST">
            <!-- Form Group (username)-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (phone number)-->
                <div class="col">
                    <label class="small mb-1" for="inputPhone">Senha</label>
                    <input class="form-control" id="inputPhone" type="password"  name="password">
                </div>
            </div>
            <!-- Form Group (email address)-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (phone number)-->
                <div class="col">
                    <label class="small mb-1" for="inputPhone">Confirmação da Senha</label>
                    <input class="form-control" id="inputPhone" type="password"  name="password_confirmation" >
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{$id}}">
            <!-- Save changes button-->
            <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
        </form>
    </div>
</div>