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
    getProfiles(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/geAllProfiles'
        }).then((response) =>{
            
            
            const data = []
            for(let i in response.data){
                data.push({
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
    }
}