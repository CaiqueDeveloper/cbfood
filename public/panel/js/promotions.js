const Promotions = {
    construct(){
        Promotions.init_listerns()
    },
    init_listerns(){
        $('.show-modal-create-promotion').on('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation()
            
            let url = window.location.origin + '/admin/showModalCreateNewPromotion'
            Promotions.showModalCreateNewPromotion(url)
        })

        $('#type_descount').on('change', function(e){
            if($(this).val() == 'direct_discount'){
                $('#discount').mask("#,##0.00", {reverse: true})
            }else{
                if($(this).val() == 'percentage'){
                    $('#discount').mask("#,##0.00", {reverse: true})
                }
            }
        })
        $('select[name=type_promotion]').on('change', function(e){
            switch($(this).val()){
                case 'category':
                case 'product':
                    Promotions.getDataRenderSelector($(this).val());
                    $('.content-render-selector').removeClass('d-none')
                break;
                case 'store':
                    $('.content-render-selector').addClass('d-none')
                break;
           }
        })
        let start = moment();
        let end = moment();
        $('#datetange-period-promotion').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            startDate: start,
            endDate: end,
            opens: 'left',
        }, function(start_, end_, label) {
            start = moment(start_).format("YYYY-MM-DD");
            end = moment(end_).format("YYYY-MM-DD");
            
        });
        $('.storage-promotion').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/admin/storagePromotion';
            let form = new FormData(this)
            form.append('periodStart', moment(start).format('YYYY-MM-DD'))
            form.append('periodEnd', moment(end).format('YYYY-MM-DD'))
            form.delete('datetange-period-promotion')
            Promotions.storagePromotion(url, form);
        })
        
    },
    showModalCreateNewPromotion(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Cadastrar Promoção');
            Promotions.init_listerns()

        }).catch((error) => {
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    getDataRenderSelector(typeItemPromotion){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + '/admin/getDataRenderSelector',
            params:{typeItemPromotion}
        }).then((response) => {
            Promotions.creatingSelectorBasedOfTheTypePromotion(response.data)
        }).catch((error) =>{
            console.log(error.response.data)
        }).finally(() =>{
            $('.AppBlock').addClass('d-none');
        })
    },
    creatingSelectorBasedOfTheTypePromotion(data){
        let option = '';
        for(let i in data){
            option += `<option value="${data[i].id}" selected>${data[i].name}</option>`
        }
        
        $('#select-type-promotion').html(option);
    },
    storagePromotion(url, data){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:url,
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            if(response.data){
                swal(
                    'Sucesso!',
                    'Promoçaõ Cadastrada com sucesso',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    console.log(response.data)
                    $("#modalMain").modal('hide');
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