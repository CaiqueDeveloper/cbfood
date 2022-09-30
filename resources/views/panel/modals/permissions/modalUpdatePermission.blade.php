<div class="row">
    <div class="col">
        <form class="form-update-permission">
            <div class="form-group ">
                <label for="profileName">Nome</label>
                <input type="text" name="name" class="form-control" id="profileName" aria-describedby="emailHelp" value="{{$permission->name}}">
                <small id="emailHelp" class="form-text text-muted">Ex: showBtnCreateProfile</small>
                
            </div>
            <div class="form-row">
              <div class="form-group col">
                  <label for="title">Descrição</label>
                  <input type="text" name="label" class="form-control" id="title">
                  <small id="emailHelp" class="form-text text-muted">Ex:Exibir Botão Para Criar novo Perfil</small>
              </div>
              <div class="form-group col-3">
                <label for="category">È um módulo?</label>
                <select id="hasModules" class="form-control" name="hasModules">
                    <option value=""></option>
                    <option value="1" @if($permission->hasModules == 1) selected @endif>Sim</option>
                    <option value="0" @if($permission->hasModules == 0) selected @endif>Não</option>
                </select>
              </div>
            </div>
            <div class="form-row section-module" @if(!$permission->hasModules) style="display: none" @endif>
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Nome do Módulo</label>
                  <input type="text" name="menu_name"class="form-control" value="{{$permission->menu_name}}">
                  <small id="emailHelp" class="form-text text-muted">Ex: Dashboard</small>
                </div>
                <div class="form-group col-md-4 content-input-price">
                  <label for="inputEmail4">URL do módulo</label>
                  <input type="text" name="url"class="form-control" value="{{$permission->url}}">
                  <small id="emailHelp" class="form-text text-muted">Ex: /dashboard</small>
                </div>
                <div class="form-group col-md-4 content-input-price">
                  <label for="inputEmail4">Icone do Módulo</label>
                  <input type="text" name="icon_class"class="form-control" value="{{$permission->icon_class}}">
                  <small id="emailHelp" class="form-text text-muted">Ex: fa fa-arrow-up-square</small>
                </div>
            </div>
            <input type="hidden" name="permission_id" value="{{$permission->id}}">
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
    </div>
</div>