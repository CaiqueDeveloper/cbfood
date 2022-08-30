const Company = {

    construct(){
        Company.init_listners()
        Ultils.filters_golbal()
        Ultils.geAddresBasedCep()
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
        
        
        setTimeout(()=>{
            $('#user-secury-tab').click()
        },700)
        setTimeout(()=>{
            $('#user-folks-tab').click()
        },900)
        $('.remove-color').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let company_id = $(this).attr('value');
            let typeColor = $(this).attr('data-type');
            let url = window.location.origin + '/admin/removeCompanyDefaultColor'
            Company.removeCompanyDefaultColor(url, company_id, typeColor);
        })
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
    removeCompanyDefaultColor(url, company_id, typeColor){
        $('.AppBlock').removeClass('d-none');
    
        axios({
            url:url,
            method: 'POST',
            data: {
                company_id:company_id,
                typeColor:typeColor
            },
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
    
}