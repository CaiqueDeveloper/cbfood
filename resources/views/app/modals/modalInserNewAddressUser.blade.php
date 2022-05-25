<div class="col order-md-1">
    <form class="needs-validation form-insert-new-address-user" >
        <div class="row font-bold text-gray-900">
            <div class="col-md-6 mb-3">
                <label for="firstName">Estado</label>
                <input type="text" class="form-control" name="states" placeholder="" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">CEP</label>
                <input type="text" class="form-control" name="zipe_code" placeholder="" required>
            </div>
        </div>
        <div class="row font-bold text-gray-900">
            <div class="col-md-6 mb-3">
                <label for="firstName">Cidade</label>
                <input type="text" class="form-control" name="city" placeholder="" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">Rua</label>
                <input type="text" class="form-control" name="road" placeholder="" required>
            </div>
        </div>
        <div class="row font-bold text-gray-900">
            <div class="col-md-6 mb-3">
                <label for="firstName">Bairro</label>
                <input type="text" class="form-control" name="distric" placeholder="" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">Nª</label>
                <input type="text" class="form-control" name="number" placeholder="" required>
            </div>
        </div>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <button class="bg-green-300 text-green-600 font-bold p-2 rounded-xl text-xl" type="submit">Cadastra novo endereço</button>
        </div>
    </form>
</div>