<div class="row">
    <div class="col-lg-12">
    <form class="form-update-item-additional">
        <div class="form-group">
            <label for="name" class="">Nome <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" value="{{$itemAdditional->name}}">
        </div>
        <div class="form-group">
            <label for="description" class="">Descrição</label>
            <textarea id="description" name="description" class="form-control">{{$itemAdditional->description}}</textarea>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="price" class="">Preço <span class="text-danger">*</span></label>
                    <input type="text"  id="price" class="col-12 form-control" name="price" value="{{$itemAdditional->price}}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="code" class="">Código</label>
                    <input id="code" name="code" type="text" class="form-control" value="{{$itemAdditional->code}}">
                </div></div>
            </div>
            <div class="form-row">
                <div class="form-group col">
                    <label for="group" class="">Grupo <span class="text-danger">*</span></label>
                    <select type="select" id="group" name="additional_id" class="custom-control-empty custom-select">
                        @foreach($additionals as $additional)
                        <option value="{{$additional->id}}" @if($itemAdditional->additional_id == $additional->id) selected @endif>{{$additional->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col">
                    <label for="category">Status</label>
                    <select id="category" class="form-control" name="status">
                        <option value="1" @if($itemAdditional->status == 1) selected @endif>Disponível</option>
                        <option value="0" @if($itemAdditional->status == 0) selected @endif>Indisponível</option>
                    </select>
                </div>
            </div>
            <input id="code" name="itemAdditional_id" type="hidden" class="form-control" value="{{$itemAdditional->id}}">
            <button type="submit" class="w-100 mt-3 btn btn-primary"><i class="fa fa-plus"></i> Editar item</button>
        </form>
    </div>
</div>