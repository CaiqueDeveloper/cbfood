const Ultils = {
    construct(){
     Ultils.init_listerns()
     Ultils.getNotifyComapy();
     Ultils.getTheNameOfTheModuleTheUserIsAccessing()
     $('.showNotify').on('click', function(e){
        e.preventDefault()
        Ultils.rendeBoxNotifyCompany();
     })
    },
    filters_golbal(){
        $('.price').mask("#,##0.00", {reverse: true})
        $('.phone').mask('(00)  0000-0000');
        $('.cep').mask('00000-000');
        $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    },
    geAddresBasedCep(){
        $('input[name="zipe_code"]').blur(function(){
            var cep =$('input[name="zipe_code"]').val().replace(/\D/g, '');
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $('input[name="road"]').val("...");
                    $('input[name="distric"]').val("...");
                    $('input[name="city"]').val("...");
                    $('input[name="states"]').val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $('input[name="road"]').val(dados.logradouro);
                            $('input[name="distric"]').val(dados.bairro);
                            $('input[name="city"]').val(dados.localidade);
                            $('input[name="states"]').val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                }
            }
        })
    },
    init_listerns(){
       
        $(".updataIdCompany").on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            if($('.content-select-companies').hasClass('d-none')){
                $('.content-select-companies').removeClass('d-none')
            }else{
                $('.content-select-companies').addClass('d-none')
            }
        })
        $('#chancheCompany').on('change', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let company_id = $(this).val();
            let url = window.location.origin + '/admin/changeCompany';
            Ultils.changeCompany(url, company_id);
        })
        $('.open-menu-page').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let slug = $(this).attr('data-slug_url')
            let url =  window.location.origin+`/app/menu/${slug}`
            window.open(url, '_blank')
        })
        $('.opennedSotore').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/admin/OpenedOrClosedStore'
            let hasOpeneed = $(this).attr('data-hasOpeneed')
            Ultils.OpenedOrClosedStore(url, hasOpeneed)
        })
    },
    runAtcinoApplyDatableInTable(model){
        let tables = []
        let i = 0
        $('table').each(function(){
            tables[i]  = $(this).DataTable({
                "retrieve": true,
                "fnDrawCallback": function (oSettings) {
                   model.init_listerns()
                }
            })
            i++
        })
    },
    mountSelectChangeCompany(companies, company_id){
        let option = '';
        for(let i in companies){
            let selected = ''
            // if(company_id == companies[i].id){
            //     selected = 'selected';
            //     $('.content-company-name').html(companies[i].name)
            // }
            option += `<option value="${companies[i].id}" ${selected}>${companies[i].name}</option>`
        }
        $('#chancheCompany').html(option)
    },
    applayMasMonay(){
        $('input[name=price]').mask("#,##0.00", {reverse: true});
        $('#price').mask("#,##0.00", {reverse: true});
    },
    changeCompany(url, company_id){
        axios({
            url: url,
            method:'GET',
            params: {company_id:company_id},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            if(response.data){
                swal(
                    'Sucesso!',
                    'Estamos lhe redirecionando.',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    window.location = '/admin/dashboard';
                },3000)
            }
        })
        .catch((error) =>{
            console.log(error.response.data)
        })
        
    },
    uploadedFile(url ,data){
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
           /// Ultils.validatorErro(error.response.data)
            $.each(error.response.data.errors, function(i, error) {
                let alertError = $(document).find('[name="' + i + '"]');
                alertError.after($('<strong style="color: red;">Aviso: ' + error[0] + '</strong></br>'));
    
            });
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    formatMoney(element) {
    	return accounting.formatMoney(element, "R$ ", 2, ".", ",");
    },
    formatMoneyChart(number) {
    	if (number != null) {
    		var number = number.toFixed(2).split('.');
    		number[0] = "R$ " + number[0].split(/(?=(?:...)*$)/).join('.');
    		return number.join(',');
    	} else {
    		return '-';
    	}
    },
    rendeBoxNotifyCompany(){
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/renderBoxNotifyCompany',
           
        })
        .then((response) =>{
            $('.content-render-notify').html(response.data.view)
        }).catch((error) =>{
            console.log(error.response.data)
        })
    },
    getNotifyComapy(){
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/getNotifyCompany',
           
        })
        .then((response) =>{
            $('.count-notify').html(response.data.length)
        }).catch((error) =>{
            console.log(error.response.data)
        })
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
                                window.location.href = "/admin/dashboard"
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
                        window.location.href = "/admin/dashboard"
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
    

    getTheNameOfTheModuleTheUserIsAccessing() {
        axios({
            url: window.location.origin+'/admin/storageNameModuleUserAccessing',
            method: 'POST',
            data: {module: window.location.pathname},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            console.log(response.data)
        })
        .catch((error) =>{
           console.log(error.response.data)
        })
    },
}