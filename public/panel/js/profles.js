const Profiles = {

    construct(){
        Profiles.init_listerns()
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
    }
}