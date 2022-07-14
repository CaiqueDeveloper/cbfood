const Company = {

    construct(){
        Company.init_listners()
    },
    init_listners(){
        $('.company-uploaded-file').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();

            
            let url = window.location.origin + '/admin/uploadedFile'
            Ultils.uploadedFile(url, this);
        })
        $('.company-folks').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/storageOrCreateCompany'
            Company.storageOrCreateCompany(url, this);
        })
        $('.company-address').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin = '/admin/updateOrInserAddreCompany'
            Company.updateOrInserAddreCompany(url, this)
        })
        $('.comspany-uploaded-file').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/uploadedFile'
            Ultils.uploadedFile(url, this);
        })
        $('.company-setting').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/updateSettingCompany'
            Company.updateSettingCompany(url, this);
        })
        $('.settgin-uploaded-banner').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/uploadedFile'
            Ultils.uploadedFile(url, this);
        })
        $('.opennedSotore').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/OpenedOrClosedStore'
            let hasOpeneed = $(this).attr('data-hasOpeneed')
            Company.OpenedOrClosedStore(url, hasOpeneed)
        })
        
        setTimeout(()=>{
            $('#user-secury-tab').click()
        },500)
        setTimeout(()=>{
            $('#user-folks-tab').click()
        },700)
            
    },
    storageOrCreateCompany (url ,data){
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
    updateSettingCompany (url ,data){
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
    updateOrInserAddreCompany(url ,data){
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
    OpenedOrClosedStore(url ,hasOpeneed){
        
        if(hasOpeneed == 0){
            swal({
                title: 'Tem certeza que deseja fechar a loja por hoje ?',
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
                        params: {hasOpeneed:hasOpeneed},
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
                                window.location.href = "/admin"
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
        }else{
            $('.AppBlock').removeClass('d-none');
            axios({
                url:url,
                method: 'GET',
                params: {hasOpeneed:hasOpeneed},
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
                        window.location.href = "/admin"
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
        
    },
    
}