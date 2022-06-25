const Profiles = {

    construct(){
        Profiles.init_listerns()
        Profiles.getProfiles()
    },
    init_listerns(){
        $('.show-modal-create-new-profile').on('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation()
            
            const url = window.location.origin + '/admin/showModalCreateNewPorifle'
            Profiles.showModalCreateNewProfile(url)
        })
        $('.form-create-profile').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            const url = window.location.origin + '/admin/storageProfile'
            Profiles.storageProfile(url, this)
        })
        $('.show-modal-update-profile').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/showModalUpdateProfile/'+$(this).attr('value')
            Profiles.showModalUpdateProfile(url);
        })
        $('.form-update-profile').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            const url = window.location.origin + '/admin/updateProfile'
            console.log(this)
            Profiles.updateProfile(url, this)
        })
        $('.delete-profile').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/delteProfile/'+$(this).attr('value');
            Profiles.delteProfile(url)
        })
        $('.show-modal-associate-profile-with-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/showModalAllUserAssociateWithProfile/'+$(this).attr('value');
            Profiles.showModalAllUserAssociateWithProfile(url)
        })
    },
    showModalCreateNewProfile(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar novo Perfil');
            Profiles.init_listerns()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    storageProfile(url, data){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'POST',
            url:url,
            data: new FormData(data)
        }).then((response) => {
            if(response.data){
                swal(
                    'Sucesso!',
                    'Parabéns Perfil Cadatrado Com Sucesso.',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    Profiles.getProfiles();
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
    updateProfile(url, data){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'POST',
            url:url,
            data: new FormData(data)
        }).then((response) => {
            if(response.data){
                swal(
                    'Sucesso!',
                    'Parabéns Perfil Editado Com Sucesso.',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    Profiles.getProfiles();
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
    delteProfile(url){
        
        swal({
            title: 'Tem certeza que deseja deletar esse perfil?',
            text: "Ao deletar esse perfil, todos os usuários associado a ele perderão acesso a determinadas funcionalidades da plataforma que estão ligada diretamente com ele",
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
                            'Pefil Deletada com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Profiles.getProfiles()
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
    getProfiles(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/geAllProfiles'
        }).then((response) =>{
            
            
            const data = []
            for(let i in response.data){
                data.push({
                    'id': response.data[i].id,
                    'name': response.data[i].name,
                    'description': response.data[i].label,
                    'created_at': moment(response.data[i].created_at).format('DD/MM/YYYY'),
                })
            }
            Profiles.drawTableProfiles(data)
        }).catch((error) =>{
            console.log(error.response.data)
        }).finally(() =>{
            $('.AppBlock').addClass('d-none');
        })
    },
    drawTableProfiles(data){

        const columns = [{
            field: "",
            title: "Nome"
        }, {
            field: "",
            title: "Descrição"
        }, {
            field: "",
            title: "Data de Criação"
        },{
            field: "",
            title: "Ações"
        }];
        $('.table-profiles').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: false,
            searching: false,
            destroy:true,
            "displayLength": 50,
            order: [[ 1, "asc" ]],
           drawCallback: function( settings ){
               Profiles.init_listerns()
           },
            columnDefs: [{
                targets: 0,
                //width: 100,
                data: function(row, type, val, meta) {
                   return row.name;
                }
            }, {
                targets: 1,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.description;
                }
            },{
                targets: 2,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.created_at;
                }
            }, {
                targets: 3,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return `
                    <a href="#" class="show-modal-update-profile text-info" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                    <a href="#" class="delete-profile text-danger" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                    <a href="#" class="show-modal-associate-profile-with-user text-success" value='${row.id}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                    </a>
                    `;
                }
            }],
        
         })
    },
    showModalUpdateProfile(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Atualizar Pefil');
            Profiles.init_listerns()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    showModalAllUserAssociateWithProfile(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Associar Perfil ao Usuário');
            Profiles.init_listerns()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    }
}