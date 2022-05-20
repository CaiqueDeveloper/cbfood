const Additionals = {
    construct(){
        Additionals.init_listerns()
        Additionals.renderViewContentAdditional()
    },
    init_listerns(){
        $('.show-modal-create-group-additional').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/getModalCreateGroupAdditional'
            Additionals.getModalCreateGroupAdditional(url);
        })
        $('.show-modal-create-item-additional').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/getModalCreateItemAdditional'
            Additionals.getModalCreateItemAdditional(url);
        })
        $('.form-create-group').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/storageGropAdditional'
            Additionals.storageGropAdditional(url, this)
        })
        $('.form-create-item-additional').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/storageItemAdditional'
            Additionals.storageItemAdditional(url, this)
        })
        $('.delete-additional').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let additional_id = $(this).attr('value')
            let url = window.location.origin + '/admin/deleteAdditional/'+additional_id;
            Additionals.deleteAdditional(url)
        })
        $('.delete-item-additonal').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let id = $(this).attr('value')
            let url = window.location.origin + '/admin/deleteItemAdditional/'+id;
            Additionals.deleteItemAdditional(url)
        })
        $('.show-modal-update-additional').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let additional_id = $(this).attr('value')
            let url = window.location.origin + '/admin/getModalUpdateAdditional/'+additional_id;
            Additionals.getModalUpdateAdditional(url)
        })
        $('.show-modal-update-item-additional').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let id = $(this).attr('value')
            let url = window.location.origin + '/admin/getModalUpdateIemAdditional/'+id;
            Additionals.getModalUpdateIemAdditional(url)
        })
        $('.form-update-group').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/storageUpdateAdditonal'
            Additionals.storageUpdateAdditonal(url, this)
        })
        $('.form-update-item-additional').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/storageUpdateItemAdditional'
            Additionals.storageUpdateItemAdditional(url, this)
        })
    },
    renderViewContentAdditional(){
        axios({
            url: window.location.origin + '/admin/renderViewContentAdditional',
            method:'GET'
        }).then((response) =>{
            console.log(response.data.view)
            $('.content-render-view').html(response.data.view)
            Additionals.init_listerns()

        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    getModalCreateGroupAdditional(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar novo Grupo');
            Additionals.init_listerns()

        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    getModalUpdateAdditional(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Editar Grupo');
            Additionals.init_listerns()

        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    getModalUpdateIemAdditional(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Editar Grupo');
            Additionals.init_listerns()
            Ultils.applayMasMonay();
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    getModalCreateItemAdditional(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Editar Item');
            Additionals.init_listerns()
            Ultils.applayMasMonay();
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    storageGropAdditional(url, data){
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
                    'Grupo Cadastrada com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    Additionals.renderViewContentAdditional()
                    swal.close()
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
    storageItemAdditional(url, data){
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
                    'Item Editado com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    Additionals.renderViewContentAdditional()
                    swal.close()
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
    storageUpdateAdditonal(url, data){
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
                    'Item Cadastrada com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    Additionals.renderViewContentAdditional()
                    swal.close()
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
    storageUpdateItemAdditional(url, data){
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
                    'Item Editado com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
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
    deleteAdditional(url){
        swal({
            title: 'Tem certeza que deseja deletar essa esse grupo de adicionais ?',
            text: "Ao deletar esse grupo os itens pertencentes a ele também serão deletado.",
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
                            Additionals.renderViewContentAdditional()
                            swal.close()
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
    deleteItemAdditional(url){
        swal({
            title: 'Tem certeza que deseja deletar essa esse grupo de adicionais ?',
            text: "Ao deletar esse grupo os items que estavam associados a ela não irão mais ser exibidos para o usuário",
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
                            Additionals.renderViewContentAdditional()
                            swal.close()
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