<div class="row">
    <div class="col">
        <form class="user-address" method="post">
            <!-- Form Group (username)-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (phone number)-->
                <div class="col-md-3">
                    <label class="small mb-1" for="inputBirthday">CEP</label>
                    <input class="form-control cep" id="inputBirthday" type="text" name="zipe_code" value="@if(@count($address) > 0) {{$address[0]->zipe_code}} @endif">
                </div>
                <div class="col-md-3">
                    <label class="small mb-1" for="inputPhone">Estado</label>
                    <input class="form-control" id="inputPhone" type="text" name="states" value="@if(@count($address) > 0) {{$address[0]->states}} @endif">
                </div>
                <!-- Form Group (birthday)-->
                
                <div class="col-md-6">
                    <label class="small mb-1" for="inputBirthday">Cidade</label>
                    <input class="form-control" id="inputBirthday" type="text" name="city" value="@if(@count($address) > 0) {{$address[0]->city}} @endif">
                </div>
            </div>
            <!-- Form Group (email address)-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (phone number)-->
                <div class="col-md-5">
                    <label class="small mb-1" for="inputPhone">Bairro</label>
                    <input class="form-control" id="inputPhone" type="text" name="distric" value="@if(@count($address) > 0) {{$address[0]->distric}} @endif">
                </div>
                <!-- Form Group (birthday)-->
                <div class="col-md-5">
                    <label class="small mb-1" for="inputBirthday">Rua</label>
                    <input class="form-control" id="inputBirthday" type="text" name="road" value="@if(@count($address) > 0) {{$address[0]->road}} @endif">
                </div>
                <div class="col-md-2">
                    <label class="small mb-1" for="inputBirthday">Nª</label>
                    <input class="form-control" id="inputBirthday" type="text" name="number" value="@if(@count($address) > 0) {{$address[0]->number}} @endif">
                </div>
            </div>
            <input type="hidden" id="custId" name="user_id" value="{{$id}}">
            <!-- Save changes button-->
            <input type="submit" value="Salvar" class="btn btn-primary btn-user btn-block">
        </form>
    </div>
</div>