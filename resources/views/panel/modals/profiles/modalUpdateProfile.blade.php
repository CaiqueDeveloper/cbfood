<div class="row">
    <div class="col">
        <form class="form-update-profile">
            <div class="form-group ">
                <label for="profileName">Nome</label>
                <input type="text" name="name" class="form-control" id="profileName" aria-describedby="emailHelp" value="{{$profile->name}}">
                <small id="emailHelp" class="form-text text-muted">Ex: adm</small>
                
            </div>
            <div class="form-group">
                <label for="title">Descrição</label>
                <input type="text" name="label" class="form-control" id="title" value="{{$profile->label}}">
                <small id="emailHelp" class="form-text text-muted">Ex: Administrador</small>
            </div>
            <input type="hidden" name="profile_id" value="{{$profile->id}}">
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
</div>