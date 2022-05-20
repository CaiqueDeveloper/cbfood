const Auth = {

    construct(){
        Auth.register();
        Auth.login();
    },
    register(){
        $('#requestFreeDemo').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $('.form-group strong').each(function(i, elment){
              elment.remove()
            })
            $('.form-group br').each(function(i, elment){
              elment.remove()
            })
            let url = window.location.origin + '/auth/storage'
            Auth.storage(url, this)
        })
    },
    login(){
        $('.login').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $('.form-group strong').each(function(i, elment){
              elment.remove()
            })
            $('.form-group br').each(function(i, elment){
              elment.remove()
            })
            let url = window.location.origin + '/auth/actionLogin'
            Auth.Actonlogin(url, this)
        })
    },
    storage(url, data){
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
                    'Login',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    window.location = '/admin';
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
    Actonlogin(url, data){
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
                    'Estamo lhe redirecionado.',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    window.location = '/admin';
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
    }
}