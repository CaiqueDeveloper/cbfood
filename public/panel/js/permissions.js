const Permissions = {
    construct(){
        Permissions.init_listerns()
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
    }
}