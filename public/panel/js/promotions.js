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
                    $('input[name=typeSelect]').attr('value', $(this).val())
                break;
                case 'store':
                    $('.content-render-selector').addClass('d-none')
                    $('input[name=typeSelect]').attr('value', $(this).val())
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
    }
}