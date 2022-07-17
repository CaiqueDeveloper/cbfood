const Ultils = {
    construct(){
     Ultils.init_listerns()
     Ultils.getNotifyComapy();
     $('.showNotify').on('click', function(e){
        e.preventDefault()
        Ultils.rendeBoxNotifyCompany();
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
}