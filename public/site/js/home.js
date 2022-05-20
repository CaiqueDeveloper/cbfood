var Home = {

    constructor() {
        Home.init_listerns()


    },
    init_listerns(){
        let qtModal = 0;

        $('.getModalProduct').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let product_id = $(this).attr('value')
            let url = window.location.origin + '/app/renderViewGetProduct/'+product_id;
            Home.renderViewGetProduct(url);
        })
        
       
    },
    renderViewGetProduct(url){
        axios({
            url: url,
            method:'GET'
        }).then((response) =>{
            
            $('.content-modal-view-product').html(response.data.view)
          

            Home.actionModalProduct()
            Home.init_listerns()
            

        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    actionModalProduct(){
        let qtModal = 0;
     
        $('.closed-modal').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            $('.announcementModalArea').fadeOut('slow')
        })
        
        $('.product-content-info--qtmais').on('click', function(e){
            e.preventDefault();
            qtModal++;
            $('.product-content-info--qt').html(qtModal);
        })
        $('.product-content-info--qtmenos').on('click', function(e){
            e.preventDefault();
            if(qtModal > 0){
                qtModal--
            }
            $('.product-content-info--qt').html(qtModal);
        })
        $('.product-content-info-size').on('click', function(e){
            e.preventDefault()
            $('.product-content-info-size').removeClass('bg-orange-300')
            $(this).addClass('bg-orange-300')
            let price_product_selected = $(this).attr('data-price_variation_product')
            $('.price-product-selected').html(price_product_selected)
        })
        $('.product-content-info--qt').html(qtModal);
    }
}