<div class="row">
    <div class="col-lg-12">
    <form class="form-update-group">
        <div class="form-group">
            <label for="name" class="">Nome <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" value="{{$additional->name}}">
            <input id="name" name="additional_id" type="hidden" class="form-control" value="{{$additional->id}}">
        </div>
            <button type="submit" class="w-100 mt-3 btn btn-primary"><i class="fa fa-plus"></i> Editar grupo</button>
        </form>
    </div>
</div>