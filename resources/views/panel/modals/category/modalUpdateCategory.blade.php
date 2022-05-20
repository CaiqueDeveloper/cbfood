<form class="form-update-category">
    <div class="form-group">
        <label for="name" class="">Nome <span class="text-danger">*</span></label>
        <input id="name" name="name" type="text" class="form-control" value="{{$category->name}}">
        <input id="name" name="company_id" type="hidden" class="form-control" value="{{$id}}">
    </div>
    <button type="submit" class="w-100 mt-3 btn btn-primary">
        <i class="fa fa-plus mr-2"></i>Editar categoria
    </button>
</form>