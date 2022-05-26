const Category = {
    construct(){
        Category.inti_listerns();
        Category.getAllCategoryCompany()
    },
    inti_listerns(){
        $('.show-modal-create-category').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin +'/admin/getModalCreateCategory'
            Category.getModalCreateCategory(url)
        })
        $('.form-create-category').on('submit', function(e){
            e.preventDefault()
               e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/storageCategory'
            Category.storageCategory(url, this);
        })
       $('.delete-category').on('click', function(e){
           e.preventDefault()
           e.stopImmediatePropagation()
           let category_id = $(this).attr('value');
           let url = window.location.origin = '/admin/deleteCategory/'+category_id
           Category.deleteCategory(url);
       })
       $('.update-category').on('click', function(e){
           e.preventDefault()
           e.stopImmediatePropagation()
           let category_id = $(this).attr('value');
           let url = window.location.origin = '/admin/getModalUpdateCategory/'+category_id
           Category.getModalUpdateCategory(url);
       })
       $('.form-update-category').on('submit', function(e){
           e.preventDefault()
           e.stopImmediatePropagation()
           let url = window.location.origin = '/admin/storageUpdateCategory'
           Category.storageUpdateCategory(url, this);
       })
    },
    getModalCreateCategory(url){
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{

            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar Categoria');
            
            Category.inti_listerns()
        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(() => {
            console.log('finalizou a consulta..')
        })
    },
    getModalUpdateCategory(url){
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{

            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Atualizar Categoria');
            Category.inti_listerns()
        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(() => {
            console.log('finalizou a consulta..')
        })
    },
    getAllCategoryCompany(){
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/getAllCategoryCompany'
        }).then((response) =>{
            
            Category.drawTableCategories(response.data)
        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(() => {
            console.log('finalizou a consulta..')
        })
    },
    storageCategory(url, data){
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
                    'Categoria Cadastrada com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    Category.getAllCategoryCompany()
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
    storageUpdateCategory(url, data){
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
                    'Categoria Editada com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    Category.getAllCategoryCompany()
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
    drawTableCategories(data){

        const columns = [{
            field: "",
            title: "ID"
        }, {
            field: "",
            title: "Nome"
        },{
            field: "",
            title: "Ações"
        }];
        $('.table-category').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: true,
            searching: true,
            destroy:true,
            "displayLength": 50,
            order: [[ 1, "asc" ]],
           drawCallback: function( settings ){
               Category.inti_listerns()
           },
            columnDefs: [{
                targets: 0,
                width: 100,
                data: function(row, type, val, meta) {
                   return row.id;
                }
            }, {
                targets: 1,
                data: function(row, type, val, meta) {
                    return row.name;
                }
            }, {
                targets: 2,
                data: function(row, type, val, meta) {
                    return `
                    <a href="#" class="update-category text-info" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="delete-category text-danger" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                    `;
                }
            }],
        
         })
    },
    deleteCategory(url){
        swal({
            title: 'Tem certeza que deseja deletar essa categoria ?',
            text: "Ao deletar essa categoria os produtos que estavam associados a ela não irão mais ser exibidos para o usuário",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            'Categoria Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Category.getAllCategoryCompany()
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
    }
}