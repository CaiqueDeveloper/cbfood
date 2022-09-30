<form class="form-create-product" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group">
            <label for="exampleFormControlFile1">Selecione as Imagens do Produto</label>
            <input type="file" class="form-control-file" name="images[]" multiple>
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Nome</label>
        <input type="text" name="name"class="form-control" >
      </div>
      <div class="form-group col-md-6 content-input-price">
        <label for="inputEmail4">Preço Base do Produto</label>
        <input type="text" name="price"class="form-control" >
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="category">Categoria</label>
            <select id="category" class="form-control" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="for-row">
        <div class="form-group">
            <label for="descriptionPoduct">Descreva o Produto</label>
            <textarea class="form-control" id="descriptionPoduct" rows="3" name="description"></textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
          <label for="category">Tem Varições ?</label>
          <select id="hasVariations" class="form-control" name="hasVariations">
              <option value=""></option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
          </select>
        </div>
        <div class="form-group col">
          <label for="category">Tem Adicionais/Complemento ?</label>
          <select id="hasAdditionals" class="form-control" name="hasAdditionals">
              <option value=""></option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
          </select>
        </div>
        <div class="form-group col">
          <label for="category">O Cliente pode especificar?</label>
          <select id="canPrice" class="form-control" name="canPrice">
              <option value=""></option>
              <option value="1">Sim</option>
              <option value="0">Não</option>
          </select>
        </div>
      </div>
    {{-- variations area --}}
    <div class="content-variation-area mb-4" style="display: none">
        <h5 class="my-3">Adicionar Variações do Produto</h5>
        <div class="row flex-column flex-sm-row input_fields_wrap">
            <div class="col  ">
                <label for="name">Nome da Variação</label>
                <input type="text" class="form-control form-control-user" id=""
                    placeholder="Ex: Pequeno,Médio, Grande" name="variationName[]" value="">
                <input type="hidden"  name="fieldVariation[]" class="btn fieldVariation btn-primary btn-user btn-block">
            </div>
            <div class="col ">
                <label for="name">Tipo da Variação</label>
                <input type="text" class="form-control form-control-user" id=""
                    placeholder="Ex: 200mg, 500mg, 750mg" name="variationType[]" value="">
            </div>
            <div class="col ">
                <label for="name">Preço da Variação</label>
                <section style="display: flex;align-items: center;">
                    <input type="text" class="form-control form-control-user" id=""
                    placeholder="R$ 10,00" name="variationPrice[]" value="">
                   <a href="" class="btn btn-info rounded-circle border-0 add_field_button" style="margin-left: 10px"><i class="fa fa-plus icon-acc"></i></a>
                </section>
            </div>
        </div>
    </div>
    {{-- additionals area --}}
    <div class="content-additional-area mb-4" style="display: none">
        <h5 class="my-3">Adicionais/Complementos</h5>
        <div class="row flex-column ml-1">
          @foreach($additionals as $additional)
            <div class="form-check">
                <input class="form-check-input" id="{{$additional->id}}" value="{{$additional->id}}" name="additionals[]" type="checkbox">
                <label class="form-check-label" for="{{$additional->id}}" style="cursor: pointer">{{$additional->name}}</label>
            </div>
          @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>