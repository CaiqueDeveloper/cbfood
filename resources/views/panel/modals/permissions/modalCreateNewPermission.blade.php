<div class="row">
    <div class="col">
        <form class="form-create-permission">
            <div class="form-group ">
                <label for="profileName">Nome</label>
                <input type="text" name="name" class="form-control" id="profileName" aria-describedby="emailHelp">
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
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
              </div>
            </div>
            <div class="form-row section-module" style="display: none">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Nome do Módulo</label>
                  <input type="text" name="menu_name"class="form-control" >
                  <small id="emailHelp" class="form-text text-muted">Ex: Dashboard</small>
                </div>
                <div class="form-group col-md-4 content-input-price">
                  <label for="inputEmail4">URL do módulo</label>
                  <input type="text" name="url"class="form-control" >
                  <small id="emailHelp" class="form-text text-muted">Ex: /dashboard</small>
                </div>
                <div class="form-group col-md-4 content-input-price">
                  <label for="inputEmail4">Icone do Módulo</label>
                  <input type="text" name="icon_class"class="form-control" >
                  <small id="emailHelp" class="form-text text-muted">Ex: fa fa-arrow-up-square</small>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>