var User = {
    construct(){
        Ultils.filters_golbal()
        Ultils.geAddresBasedCep()
        User.init_listerns()
        User.getUsers()
        
    },
    init_listerns(){
        $('.show-modal-create-new-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/showModalRegisterUser'
            User.showModalRegisterUser(url)
        })
        $('.form-storage-user').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/storageUser'
            User.storageUser(url, this);
        })
        $('.show-modal-update-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let user_id = $(this).attr('value')
            let url = window.location.origin + '/admin/showModalUpdateUser/'+user_id
            User.showModalUpdateUser(url);
        })
        $('.show-modal-update-address').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let user_id = $(this).attr('value')
            let url = window.location.origin + '/admin/showModalUpdateOrInserAddresUser/'+user_id
            User.showModalUpdateOrInserAddresUser(url);
        })
        $('.show-modal-update-password').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let user_id = $(this).attr('value')
            let url = window.location.origin + '/admin/showModalUpdatePassword/'+user_id
            User.showModalUpdatePassword(url);
        })
        $('.delete-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let user_id = $(this).attr('value')
            let url = window.location.origin + '/admin/deleteUser/'+user_id
            User.deleteUser(url);
        })
        $('.user-folks').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/updateUserFolks'
            User.updateUserFolks(url, this);
        })
        $('.user-change-password').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/userChangePassword'
            User.userChangePassword(url, this);
        })
        $('.user-address').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/updateOrInserAddressUser'
            User.updateOrInserAddressUser(url, this);
        })
        $('.user-uploaded-file').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/uploadedFile'
            Ultils.uploadedFile(url, this);
        })
    },
    getInfoUserLogged(){
        $('.AppBlock').removeClass('d-none');
        axios({
            url: window.location.origin + '/admin/getInfoUserLogged',
            method: 'get',
        })
        .then((response) => {
           // Ultils.mountSelectChangeCompany(response.data.user.companies, response.data.user.company_id)
        })
        .catch((error) => {
            console.log(error.response.data);
        }).finally(() => {$('.AppBlock').addClass('d-none');})
    },
    updateUserFolks(url, data){
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
                    'Alterção feita com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    User.getInfoUserLogged();
                    User.getUsers()
                    $("#modalMain").modal('hide');
                },3000)
            }
        })
        .catch((error) =>{
           /// Ultils.validatorErro(error.response.data)
            $.each(error.response.data.errors, function(i, error) {
                let alertError = $(document).find('[name="' + i + '"]');
                alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
    
            });
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    userChangePassword(url, data){
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
                    'Alterção feita com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    User.getInfoUserLogged();
                    User.getUsers()
                    $("#modalMain").modal('hide');
                },3000)
            }
        })
        .catch((error) =>{
           /// Ultils.validatorErro(error.response.data)
            $.each(error.response.data.errors, function(i, error) {
                let alertError = $(document).find('[name="' + i + '"]');
                alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
    
            });
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    updateOrInserAddressUser(url ,data){
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
                    'Alterção feita com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    User.getInfoUserLogged();
                    User.getUsers()
                    $("#modalMain").modal('hide');
                },3000)
            }
        })
        .catch((error) =>{
           /// Ultils.validatorErro(error.response.data)
            $.each(error.response.data.errors, function(i, error) {
                let alertError = $(document).find('[name="' + i + '"]');
                alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
    
            });
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    showModalRegisterUser(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar novo Usuário');
            User.init_listerns()
            Ultils.filters_golbal()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    storageUser(url, data){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'POST',
            url:url,
            data: new FormData(data)
        }).then((response) => {
            if(response.data){
                swal(
                    'Sucesso!',
                    'Parabéns Usuário Cadatrado Com Sucesso.',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    User.geUser();
                    $("#modalMain").modal('hide');
                },2000)
            }
        }).catch((error) =>{
            $.each(error.response.data.errors, function(i, error) {
                let alertError = $(document).find('[name="' + i + '"]');
                alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
    
            });
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    getUsers(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method:'GET',
            url: window.location.origin + '/admin/getUsers'
        }).then((response) =>{
            User.drawTableUsers(response.data)
        }).catch((error) =>{
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    drawTableUsers(data){
        const columns = [{
            field: "",
            title: "Nome"
        }, {
            field: "",
            title: "E-mail"
        },{
            field: "",
            title: "Nª Telefone"
        },{
            field: "",
            title: "Nª Alternativo"
        },{
            field: "",
            title: "Cadastrado Em"
        },{
            field: "",
            title: "Ações"
        }];

        $('.table-users').DataTable({
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
               User.init_listerns()
           },
            columnDefs: [{
                targets: 0,
                width: 100,
                data: function(row, type, val, meta) {
                   return row.name;
                }
            }, {
                targets: 1,
                data: function(row, type, val, meta) {
                    if( row.email != null){
                        return  row.email;
                    }else{
                        return 'E-mail não informado';
                    }
                }
            },{
                targets: 2,
                data: function(row, type, val, meta) {
                    if( row.number_phone != null){
                        return  row.number_phone;
                    }else{
                        return 'Nª Telefone não informado';
                    }
                }
            },{
                targets: 3,
                data: function(row, type, val, meta) {
                    if( row.number_phone_alternative != null){
                        return  row.number_phone_alternative;
                    }else{
                        return 'Telefone Alternativo não informado';
                    }
                }
            },{
                targets: 4,
                data: function(row, type, val, meta) {
                    return moment(row.created_at).format('DD/MM/YYYY')
                }
            }, {
                targets: 5,
                data: function(row, type, val, meta) {
                    return `
                    <a href="#" class="show-modal-update-user text-info" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="show-modal-update-address text-info" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                    </a>
                    <a href="#" class="show-modal-update-password text-info" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                  </svg>
                    </a>
                    <a href="#" class="delete-user text-danger" value='${row.id}'>
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
    showModalUpdateUser(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Editar Usuário');
            User.init_listerns()
            Ultils.filters_golbal()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    showModalUpdateOrInserAddresUser(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Editar/Adicionar Endereço');
            User.init_listerns()
            Ultils.filters_golbal()
            Ultils.geAddresBasedCep()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    showModalUpdatePassword(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Trocar senha');
            User.init_listerns()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    deleteUser(url){
        
        swal({
            title: 'Tem certeza que deseja deletar esse usuário?',
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
                            'Usuário Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            User.getUsers()
                            $("#modalMain").modal('hide');
                        },3000)
                    }
                })
                .catch((error) =>{
                    console.log(error.response.data)
                })
                .finally(() =>{$('.AppBlock').addClass('d-none');});
            }
        });
    },
}