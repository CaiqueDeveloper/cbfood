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
        $('#type_descount').change(function(e){
           if($(this).val() == 'direct_discount'){
                $('#discount').attr('value', 'R$ 0,00')
                
           }else{
                $('#discount').attr('value', '% 0')
                $('#discount').mask("#,##0.00", {reverse: true})
           }
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
}