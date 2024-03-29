@extends('layouts.app.based-app')
@section('title', $menuCompany['company']->name)
@section('content-page')


<div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-[50px]">
    <div class="content sm:col-span-3">
        <!-- init section filters -->
        <div class="sm:col-span-2 sm:py-5 border-solid border-2 shadow-md rounded-md flex items-center justify-center mb-4">
            <div class="w-full header-filter flex justify-between mb-10 hidden">
                <h1 class="text-black-700 text-[16px] font-bold ml-[30px]">Filtros</h1>
            </div>
            <div class="body-filter  w-full text-black font-bold">
                <form action="" class="search-product flex flex-col sm:flex-row  items-center sm:justify-between">
                    <div class="form-group col">
                        <label for="category" class="">
                            Filtrar Por Categoria
                            <span class="text-danger">*</span>
                        </label>
                        <select type="select" id="category" name="category" class="custom-select">
                            <option value="all_category" selected>Todas as Categorias</option>
                            @foreach ($menuCompany['company']->categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col">
                        <label for="category" class="">
                            Filtrar Pelo nome
                            <span class="text-danger">*</span>
                        </label>
                        <input name="product_name" class="col-12 form-control" style="border: 1px solid #ddd;">
                        <input type="hidden" name="company_id" value="{{$menuCompany['company']->id}}">
                        
                    </div>
                    <div class="form-group col mt-4 mr-2">
                        <button type="submit" class="btn col-12 @if($menuCompany['company']->settings[0]->primaryColor != null) bg-[{{$menuCompany['company']->settings[0]->primaryColor}}] @else bg-orange-300 @endif @if($menuCompany['company']->settings[0]->secondColor != null) text-[{{$menuCompany['company']->settings[0]->secondColor}}] @else text-orange-600 @endif font-bold shadow-none">Pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- section reder view products --}}
        <div class="content-modal-view-product"></div>
        
        <div class="announcement-area relative">
                
              @if(@count($menuCompany['company']['products']) > 0)
                <div class="reder-view-all-products-company"></div>
              @else
                <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                    <p class="font-bold">Aviso</p>
                    <p>Essa Emprea ainda não fez o cadastro dos seus produtos</p>
                </div>
              @endif
        </div>
        </div>
        <!-- final section conte-body page -->
    </div>
</div>
@endsection