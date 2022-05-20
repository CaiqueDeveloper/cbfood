<div class="row">
    <div class="col-lg-12">
    <form class="form-create-item-additional">
        <div class="form-group">
            <label for="name" class="">Nome <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="description" class="">Descrição</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="price" class="">Preço <span class="text-danger">*</span></label>
                    <input type="text"  id="price" class="col-12 form-control" name="price" placeholder="R$ 0,00">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="code" class="">Código</label>
                    <input id="code" name="code" type="text" class="form-control" value="">
                </div></div>
            </div>
            <div class="form-group">
                <label for="group" class="">Grupo <span class="text-danger">*</span></label>
                <select type="select" id="group" name="additional_id" class="custom-control-empty custom-select">
                    @foreach($additionals as $additional)
                       <option value="{{$additional->id}}">{{$additional->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-100 mt-3 btn btn-primary"><i class="fa fa-plus"></i> Criar item</button>
        </form>
    </div>
</div>