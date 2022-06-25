const Permissions = {
    construct(){
        Permissions.init_listerns()
        Permissions.getPermissions()
    },
    init_listerns(){
        $('.show-modal-new-permission').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            const url = window.location.origin+'/admin/showModalCreateNewPermission'
            Permissions.showModalCreateNewPermission(url)
        })
        $('#hasModules').on('change', function(e) {
            e.stopImmediatePropagation()
            e.preventDefault();
           
            if ($(this).prop('checked')) {
                $('.section-module').fadeIn();
                $(this).attr('value', '1')
            } else {
                $('.section-module').fadeOut();
                $(this).attr('value', '0')
            }
        })
        $('.form-create-permission').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            const url = window.location.origin+'/admin/storagePermission'
            Permissions.storagePermission(url, this)
        })
    },
    showModalCreateNewPermission(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',  
            url:url
        }).then((response) => {
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar nova permissão.');
            Permissions.init_listerns()

        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    storagePermission(url, data){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'POST',
            url:url,
            data: new FormData(data)
        }).then((response) => {
            if(response.data){
                swal(
                    'Sucesso!',
                    'Parabéns Permissão Cadatrado Com Sucesso.',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    Permissions.getPermissions()
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
    getPermissions(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/geAllPermissions'
        }).then((response) =>{
            
            
            const data = []
            for(let i in response.data){
                data.push({
                    'name': response.data[i].name,
                    'description': response.data[i].label,
                    'menu': response.data[i].menu_name,
                    'url': response.data[i].url,
                    'icon': response.data[i].icon_class,
                    'hasModules': response.data[i].hasModules,
                    'created_at': moment(response.data[i].created_at).format('DD/MM/YYYY'),
                })
            }
            Permissions.drawTablePermissions(data)
        }).catch((error) =>{
            console.log(error.response.data)
        }).finally(() =>{
            $('.AppBlock').addClass('d-none');
        })
    },
    drawTablePermissions(data){

        const columns = [{
            field: "",
            title: "Nome"
        }, {
            field: "",
            title: "Descrição"
        }, {
            field: "",
            title: "Menu"
        }, {
            field: "",
            title: "URL"
        }, {
            field: "",
            title: "Icone"
        }, {
            field: "",
            title: "É um módulo?"
        }, {
            field: "",
            title: "Data de Criação"
        },{
            field: "",
            title: "Ações"
        }];
        $('.table-permissions').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: false,
            searching: false,
            destroy:true,
            "displayLength": 50,
            order: [[ 1, "DESC" ]],
           drawCallback: function( settings ){
               
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
                    return row.menu != null ? row.menu : 'NÃO DEFINIDO';
                }
            },{
                targets: 3,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.url != null ? row.url : 'NÃO DEFINIDO';
                }
            },{
                targets: 4,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.icon != null ? row.icon : 'NÃO DEFINIDO';;
                }
            },{
                targets: 5,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.hasModules != 0 ? 'É UM MÓDULO' : 'É UMA AÇÃO';
                }
            },{
                targets: 6,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.created_at;
                }
            }, {
                targets: 7,
                class: 'text-center',
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
                    <a href="#" class="delete-category text-success" value='${row.id}'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
                        </svg>
                    </a>
                    `;
                }
            }],
        
         })
    }
}