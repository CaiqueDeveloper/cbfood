const Products = {
    construct(){
        Products.init_listerns()
        Products.getAllProducts()
    },
    init_listerns(){
        $('.show-modal-create-product').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/getModalCreatProduct'
            Products.getModalCreatProduct(url)
        })
        $('.form-create-product').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/storageProdudct'
            Products.storageProdudct(url, this)
        })
        $('.form-update-product').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/storageProdudct'
            Products.storageProdudct(url, this)
        })
        $('#hasVariations').on('change', function(e) {
            e.stopImmediatePropagation()
            e.preventDefault();
           
            if ($(this).prop('checked')) {
                $('.content-variation-area').fadeIn();
                $(this).attr('value', '1')
            } else {
                $('.content-variation-area').fadeOut();
                $(this).attr('value', '0')
            }
        })
        $('#canPrice').on('change', function(e) {
            e.stopImmediatePropagation()
            e.preventDefault();
           
            if ($(this).prop('checked')) {
                $(this).attr('value', '1')
            } else {
                $(this).attr('value', '0')
            }
        })
        $('#hasAdditionals').on('change', function(e) {
            e.stopImmediatePropagation()
            e.preventDefault();
           
            if ($(this).prop('checked')) {
                $('.content-additional-area').fadeIn();
                $(this).attr('value', '1')
            } else {
                $('.content-additional-area').fadeOut();
                $(this).attr('value', '0')
            }
        })
        $('.delete-product').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let product_id = $(this).attr('value')
            let url = window.location.origin + '/admin/deleteProduct/'+product_id
            Products.deleteProduct(url);
        })
        $('.show-modal-update-product').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let product_id = $(this).attr('value')
            let url = window.location.origin + '/admin/getModalUpdateProduct/'+product_id
            Products.getModalUpdateProduct(url);
        })
        $('.delete-additiona-product').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let product_id = $(this).attr('data-product_id') 
            let additional_id = $(this).attr('value') 
            let url = window.location.origin +`/admin/deleteAdditionalProduct?product_id=${product_id}&additional_id=${additional_id}`
            Products.deleteAdditionalProduct(url)
        })
        $('.delete-image-porduct').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let image_id = $(this).attr('value')
            let product_id = $(this).attr('data-product_id') 
            let url = window.location.origin + `/admin/deleteImageProduct?product_id=${product_id}&image_id=${image_id}`
            Products.deleteImageProduct(url)  
        })
        $('.delete-varitiona-product').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let varitiation_id = $(this).attr('value')
            let url = window.location.origin + `/admin/deleteVariationProduct?varitiation_id=${varitiation_id}`
            Products.deleteVariationProduct(url)  
        })
       
    },
    getModalCreatProduct(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar novo Produto');
            Products.init_listerns()
            Products.createNewFieldsVariationAnnouncement()
            $('input[name="variationPrice[]"], input[name="price"]').mask("#,##0.00", {reverse: true})

        }).catch((error) =>{

        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    storageProdudct(url, data){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:url,
            method: 'POST',
            data: new FormData(data),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            if(response.data){
                swal(
                    'Sucesso!',
                    'Produto Cadastrado com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    Products.getAllProducts()
                    $("#modalMain").modal('hide');
                },3000)
            }
        })
        .catch((error) =>{
            $.each(error.response.data.errors, function(i, error) {
                let alertError = $(document).find('[name="' + i + '"]');
                alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
    
            });
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    createNewFieldsVariationAnnouncement: function() {
        
        var max_fields = 4; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
       
        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            setTimeout(()=>{
                $('input[name="variationPrice[]"]').mask("#,##0.00", {reverse: true})
            },300)

            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                setTimeout(()=>{
                    $('input[name="variationPrice[]"]').mask("#,##0.00", {reverse: true})
                },300)
                $(wrapper).append(
                    `  
                    <article class="row d-flex flex-column flex-sm-row w-100 ml-1 mt-3">
                          <div class="col ">
                            <label for="name">Nome da Variação</label>
                            <input type="text" class="form-control form-control-user" id=""
                                placeholder="Ex: Pequeno,Médio, Grande" name="variationName[]" value="">
                                <input type="hidden"  name="fieldVariation[]" class="btn fieldVariation btn-primary btn-user btn-block">
                        </div>
                        <div class="col">
                            <label for="name">Tipo da Variação</label>
                            <input type="text" class="form-control form-control-user" id=""
                                placeholder="Ex: 200mg, 500mg, 750mg" name="variationType[]" value="">
                                
                        </div>
                        <div class="col">
                            <label for="name">Preço da Variação</label>
                            <section style="display: flex;align-items: center;">
                                <input type="text" class="form-control form-control-user"  id="price"
                                    placeholder="R$ 10,00" name="variationPrice[]" value="">
                                <a href="#" class="remove_field btn btn-danger rounded-circle border-0 " value="" style="margin-left:10px;curso:pointer"><i class="fa fa-trash icon-acc"></i></a>
                            </section>
                        </div>
                    </article>
                    `
                ); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('section').parent('div').parent('article').remove();
            x--;
        })
    },
    getAllProducts(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/getAllProducts'
        }).then((response) =>{
            Products.drawTableProducts(response.data)
        }).catch((error) =>{

            console.log(error.response.data)
        }).finally(() => {$('.AppBlock').addClass('d-none');});
    },
    drawTableProducts(data){    
       console.log(data);
        const columns = [{
            field: "",
            title: "NOME"
        }, {
            field: "",
            title: "DESCRIPÇÃO"
        },{
            field: "",
            title: "PREÇO BASE"
        },{
            field: "",
            title: "TEM VARIÇÃO?"
        },{
            field: "",
            title: "O CLIENTE PODE PRECIFICAR?"
        },{
            field: "",
            title: "Ações"
        }];

        $('.table-products').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: true,
            searching: true,
            destroy:true,
            "displayLength": 20,
            order: [[ 1, "asc" ]],
           drawCallback: function( settings ){
               Products.init_listerns()
           },
            columnDefs: [{
                targets: 0,
                width: 100,
                data: function(row, type, val, meta) {
                   return row.name;
                }
            }, {
                targets: 1,
                class:'text-center',
                data: function(row, type, val, meta) {
                    if( row.description != null){
                        return  row.description;
                    }else{
                        return 'O Produdo não possue descrição.';
                    }
                }
            },{
                targets: 2,
                class:'text-center',
                data: function(row, type, val, meta) {
                    return 'R$ '+row.price;
                }
            },{
                targets: 3,
                class:'text-center',
                data: function(row, type, val, meta) {
                    if(row.hasVariations != '0'){
                        if(row.hasVariations == 'on' || row.hasVariations == '1'){
                            return 'Sim';
                        }
                    }else{
                        return 'Não';
                    }
                }
            },{
                targets: 4,
                class:'text-center',
                data: function(row, type, val, meta) {
                    if(row.canPrice != '0'){
                        if(row.canPrice == 'on' || row.canPrice == '1'){
                            return 'Sim';
                        }
                    }else{
                        return 'Não';
                    }
                }
            }, {
                targets: 5,
                class:'text-center',
                data: function(row, type, val, meta) {
                    return `
                    <a href="#" class="show-modal-update-product text-info" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="delete-product text-danger" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                    `
                }
            }],
        
        })
    },
    deleteProduct(url){
        swal({
            title: 'Tem certeza que deseja deletar esse produto ?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                $('.AppBlock').removeClass('d-none');
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            'Produto Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Products.getAllProducts()
                            $("#modalMain").modal('hide');
                        },3000)
                    }
                })
                .catch((error) =>{
                    $.each(error.response.data.errors, function(i, error) {
                        let alertError = $(document).find('[name="' + i + '"]');
                        alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
            
                    });
                })
                .finally(() =>{$('.AppBlock').addClass('d-none');});
            }
        });
    },
    getModalUpdateProduct(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            setTimeout(function(e){
                
                $('.image').each(function( index ){
                    let img = $(this).find('img');
                    img.attr( 'width',$(this).width());
                })
            },200)
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Utualizar Produto');
            Products.init_listerns()
            Ultils.applayMasMonay();
            Products.createNewFieldsVariationAnnouncement()
           
        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(() => {
            $('.AppBlock').addClass('d-none');
        })
    },
    deleteAdditionalProduct(url){
        swal({
            title: 'Tem certeza que deseja remover esse item? ?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                $('.AppBlock').removeClass('d-none');
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            'Item Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Products.getAllProducts()
                            let url = window.location.origin + '/admin/getModalUpdateProduct/'+response.data
                            Products.getModalUpdateProduct(url)
                            $("#modalMain").modal('hide');
                        },3000)
                    }
                })
                .catch((error) =>{
                    $.each(error.response.data.errors, function(i, error) {
                        let alertError = $(document).find('[name="' + i + '"]');
                        alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
            
                    });
                })
                .finally(() =>{$('.AppBlock').addClass('d-none');});
            }
        });
    },
    deleteImageProduct(url){
        swal({
            title: 'Tem certeza que deseja remover issa image?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                $('.AppBlock').removeClass('d-none');
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            'Item Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Products.getAllProducts()
                            let url = window.location.origin + '/admin/getModalUpdateProduct/'+response.data
                            Products.getModalUpdateProduct(url)
                            $("#modalMain").modal('hide');
                        },3000)
                    }
                })
                .catch((error) =>{
                    $.each(error.response.data.errors, function(i, error) {
                        let alertError = $(document).find('[name="' + i + '"]');
                        alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
            
                    });
                })
                .finally(() =>{$('.AppBlock').addClass('d-none');});
            }
        });
    },
    deleteVariationProduct(url){
        swal({
            title: 'Tem certeza que deseja remover essa variação?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                $('.AppBlock').removeClass('d-none');
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            'Variação Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Products.getAllProducts()
                            $("#modalMain").modal('hide');
                        },3000)
                    }
                })
                .catch((error) =>{
                    $.each(error.response.data.errors, function(i, error) {
                        let alertError = $(document).find('[name="' + i + '"]');
                        alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
            
                    });
                })
                .finally(() =>{$('.AppBlock').addClass('d-none');});
            }
        });
    },
}