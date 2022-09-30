<div class="row">
    <div class="col-lg-12">
    <form class="form-update-group">
       
        <div class="form-row">
            <div class="form-group col">
                <label for="name" class="">Nome <span class="text-danger">*</span></label>
                <input id="name" name="name" type="text" class="form-control" value="{{$additional->name}}">
                <input id="name" name="additional_id" type="hidden" class="form-control" value="{{$additional->id}}">
            </div>
            <div class="form-group col">
                <label for="category">Status</label>
                <select id="category" class="form-control" name="status">
                    <option value="1" @if($additional->status == 1) selected @endif>Disponível</option>
                    <option value="0" @if($additional->status == 0) selected @endif>Indisponível</option>
                </select>
            </div>
        </div>
            <button type="submit" class="w-100 mt-3 btn btn-primary"><i class="fa fa-plus"></i> Editar grupo</button>
        </form>
    </div>
</div>