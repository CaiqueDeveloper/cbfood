<section class="content-image-product d-flex flex-column flex-sm-row justify-between flex-wrap mb-3">
    @foreach($product->images as $image)
        <section class="image img-thumbnail  ml-2 mr-2 mb-3 position-relative col">
            <img src="/product_photo/{{$image->path}}"  alt="" width="200" height="200"> 
            <a href="#" class="position-absolute btn btn-danger btn-circle delete-image-porduct"  data-product_id="{{$product->id}}" value="{{$image->id}}" style="bottom: 10;right:20;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                </svg>
            </a>
        </section>
    @endforeach
</section>
<form class="form-update-product" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group">
            <label for="exampleFormControlFile1">Selecione as Imagens do Produto</label>
            <input type="file" class="form-control-file" name="images[]" multiple>
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Nome</label>
        <input type="text" name="name"class="form-control" value="{{$product->name}}">
      </div>
      <div class="form-group col-md-6 content-input-price">
        <label for="inputEmail4">Preço Base do Produto</label>
        <input type="text" name="price"class="form-control" value="{{$product->price}}">
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col">
            <label for="category">Categoria</label>
            <select id="category" class="form-control" name="category_id">
               
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="for-row">
        <div class="form-group">
            <label for="descriptionPoduct">Descreva o Produto</label>
            <textarea class="form-control" id="descriptionPoduct" rows="3" name="description">{{$product->description}}</textarea>
        </div>
    </div>
    <div class="form-row mb-4">
        <div class="form-check ml-2 mr-5">
            <input class="form-check-input" name="hasVariations" id="hasVariations" @if($product->hasVariations != null && $product->hasVariations == 1) checked value="1" @endif type="checkbox" >
            <label class="form-check-label" for="hasVariations" style="cursor: pointer">Tem Varições ?</label>
        </div>
        <div class="form-check mr-4">
            <input class="form-check-input" id="canPrice"  name="canPrice" @if($product->canPrice != null) checked value="1" @endif type="checkbox">
            <label class="form-check-label" for="canPrice" style="cursor: pointer">O Cliente pode especificar o valor ?</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" id="hasAdditionals" @if($product->hasAdditionals == 1) checked value="1" @endif name="hasAdditionals" type="checkbox">
            <label class="form-check-label" for="hasAdditionals" style="cursor: pointer">Tem Adicionais/Complemento ?</label>
        </div>
    </div>
    @php
     //dd($product->variations )  ; 
    @endphp
    {{-- variations area --}}
    <div class="content-variation-area mb-4 " @if($product->hasVariations == '0') style="display:none" @endif>
        <h5 class="my-3">Adicionar Variações do Produto <a href="" class="btn btn-info rounded-circle border-0 add_field_button" style="margin-left: 10px"><i class="fa fa-plus icon-acc"></i></a></h5>
        @foreach($product->variations as $keyVariation => $valueVariation)
            <div class="row flex flex-column flex-sm-row">
                <div class="col  ">
                    <label for="name">Nome da Variação</label>
                    <input type="text" class="form-control form-control-user" id=""
                        placeholder="Ex: Pequeno,Médio, Grande" name="variationName[]" value="{{$valueVariation['variationName']}}">
                    <input type="hidden" value="{{$valueVariation['id']}}" name="fieldVariation[]" class="btn fieldVariation btn-primary btn-user btn-block">
                </div>
                <div class="col ">
                    <label for="name">Tipo da Variação</label>
                    <input type="text" class="form-control form-control-user" id=""
                        placeholder="Ex: 200mg, 500mg, 750mg" name="variationType[]" value="{{$valueVariation['variationType']}}">
                </div>
                <div class="col ">
                    <label for="name">Preço da Variação</label>
                    <section style="display: flex;align-items: center;">
                        <input type="text" class="form-control form-control-user" id="price"
                        placeholder="R$ 10,00" name="variationPrice[]"  value="{{$valueVariation['variationPrice']}}">
                        <a href="#" class="btn btn-danger rounded-circle delete-varitiona-product " value="{{$valueVariation['id']}}" style="margin-left:10px;curso:pointer"><i class="fa fa-trash icon-acc"></i></a>
                    </section>
                </div>
            </div>
            <div class="row flex-column flex-sm-row input_fields_wrap">
               
            </div>
        @endforeach
    </div>
   
    {{-- additionals area --}}
    <div class="content-additional-area mb-4 "@if($product->hasAdditionals == '0') style="display:none"  @endif>
        <h5 class="my-3">Adicionais/Complementos</h5>
        <div class="row flex-column ml-1">
          @foreach($additionals as $additional)
            <div class="form-check">
                @foreach($product->additionalsProduct as $item) 
                    @if($additional->id == $item->additional_id) 
                    <a href="#" class="delete-additiona-product"  data-product_id="{{$product->id}}" value="{{$item->id}}" style="color:red;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </a>
                    @endif 
                @endforeach
                <input class="form-check-input ml-2" id="{{$additional->id}}" value="{{$additional->id}}" @foreach($product->additionalsProduct as $item) @if($additional->id == $item->additional_id) checked @endif @endforeach name="additionals[]" type="checkbox">
                <label class="form-check-label ml-4" for="{{$additional->id}}" style="cursor: pointer">{{$additional->name}} 
                    
                </label>
            </div>
          @endforeach
        </div>
    </div>
    <input type="hidden"  name="product_id" value="{{$product->id}}">
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>