<div class="row">
    <div class="col-lg-12">
        <form class="">
            <div class="form-group">
                <label for="category" class="">
                    Tipo <span class="text-danger">*</span>
                </label>
                <select type="select" id="type" name="type_promotion" class="custom-select">
                    <option value="store" selected>Loja</option>
                    <option value="category">Categoria</option>
                    <option value="product">Produto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category" class="">
                    Tipo de desconto 
                    <span class="text-danger">*</span>
                </label>
                <select type="select" id="type_descount" name="type_descount" class="custom-select">
                    <option value="percentage">Porcentagem</option>
                    <option value="direct_discount">Desconto direto</option>
                </select>
            </div>
            <div class="form-group">
                <label for="discount" class="">
                    Valor <span class="text-danger">*</span>
                </label>
                <input type="text" id="discount" class="col-12 form-control" name="discount" value="% 0">
            </div>
            <div class="form-group" style="height: 40px;">
                <div class="toggle-title">
                    <label for="open_hours" class="w-100 mb-2">
                        Definir data inicial e final<br>
                        <small>Limita a utilização de cupons entre um período de dias</small>
                    </label>
                </div>
            </div>
            <button type="submit" class="w-100 mt-3 btn btn-primary">
                <i class="fa fa-plus"></i> Criar
            </button>
        </form>
    </div>
</div>