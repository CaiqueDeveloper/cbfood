var Home = {

    constructor() {
        Home.init_listerns()
        Home.getTotalItemCart()

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
        $('.open-shopping-cart').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/app/getModalCartItem'
            Home.getModalCartItem(url)
        })
        $('.clear-cart').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin+ '/app/clear'
            Home.clearCart(url)
        })
        $('.remove-item-cart').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin+ '/app/remove/'+$(this).attr('data-id_item-cart')
            Home.removeItemCart(url)
        })
        // $('.product-content-info--qtmais').on('click', function(e){
        //     e.preventDefault();
        //     qtModal++
        //     e.find('.product-content-info--qt').html(qtModal)
        //    console.log($(this));
        // })
        $('input[name="quatity"]').on('change', function(e){
            
            let quantity = ($(this).val() > 0) ? $(this).val() : 1; 
            let product_id = $(this).attr('data-id_product')
            let url = window.location.origin + `/app/updateItemCart?product_id=${product_id}&quatity=${quantity}`;
            Home.updateItemCart(url);
        })
       $('.checout').on('click', function(e){
           e.preventDefault()
           e.stopImmediatePropagation()

           let url = window.location.origin+ '/app/getModalCheckout'
           Home.getModalCheckout(url)
       })
       $('.form-checkout-new-user').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

           let url = window.location.origin + '/app/ckeckout'
           Home.CheckoutUser(url, this)
        })
        $('.show-modal-insert-new-addrees-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/app/getModalInserNewAddressUser'
            Home.getModalInserNewAddressUser(url)
        })
        $('.form-insert-new-address-user').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/app/storageNewAddressUser'
            Home.storageNewAddressUser(url, this)
        })
        $('.send-address-user').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/app/sendOrderUser'
            Home.sendOrderUser(url, this)
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
        const cartItem = [];

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

        //Action Add Cart Item
        $('.add-cart').on('click', function(e){
            e.preventDefault();

            let identifier =$(this).attr('data-product_id')+'@'+$('.product-content-info-size.bg-orange-300').attr('data-variation_id')
            let key = cartItem.findIndex((item) => item.identifier == identifier)
            let idItemsAdditonal =  $("input[type='checkbox']:checked").map(function(i, e) {return e.value}).toArray(); 
            let price = 0;
            let image = $('.img-product').css('background-image');
            image = image.replace('url(','').replace(')','').replace(/\"/gi, "");
            console.log(idItemsAdditonal);
            if($('.price-product-selected').length > 0){
                price = $('.price-product-selected').html();
            }else{
                price = $('input[name="priceCliente"]').val()
            } 

            if(key > -1){
                cartItem[key].qtModal += qtModal
            }else{
                cartItem.push({
                    identifier,
                    product_id: $(this).attr('data-product_id'),
                    company_id: $('.announcementModalArea').attr('data-company_id'),
                    name: $('.product-name').html(),
                    price: parseFloat(price).toFixed(2),
                    quatity: qtModal,
                    image: image,
                    sizeId:  $('.product-content-info-size.bg-orange-300').attr('data-variation_id'),
                    sizeText:  $('.product-content-info-size.bg-orange-300').html(),
                    itemsAdditional: idItemsAdditonal

                })
            }
           let url = window.location.origin + '/app/cart'
           Home.addItemCart(url,cartItem)

           console.log(cartItem);
        })
    },
    addItemCart(url,cartItem){
        axios({
            url:url,
            method: 'POST',
            data: cartItem,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            
                swal(
                    'Sucesso!',
                    '',
                    'success'
                )
                setTimeout(() =>{
                    $('.announcementModalArea').fadeOut('slow')
                    Home.getTotalItemCart()
                    swal.close()
                   
                },3000)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    getModalCartItem(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Carrinho de Compras');
            Home.init_listerns()
            
            let qtModal = $('.product-content-info--qt').html(qtModal);
            
            console.log(qtModal)
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    clearCart(url){
        swal({
            title: 'Tem certeza que deseja remover todos os itens do carrinho?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            '',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Home.getTotalItemCart()
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
            }
        });
    },
    removeItemCart(url){
        swal({
            title: 'Tem certeza que deseja remover esse item do carrinho?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.value) {
                axios({
                    url:url,
                    method: 'GET',
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            '',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            Home.getTotalItemCart()
                            let url = window.location.origin + '/app/getModalCartItem'
                            Home.getModalCartItem(url)
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
            }
        });
    },
    getTotalItemCart(){
        axios({
            url:window.location.origin + '/app/cart',
            method:'GET'
        }).then((response) =>{
            $('.total-itemCart').html(Object.keys(response.data).length );
            
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    updateItemCart(url){
        axios({
            url:url,
            method: 'GET',
        })
        .then((response) =>{
            let url = window.location.origin + '/app/getModalCartItem'
            Home.getModalCartItem(url)
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    getModalCheckout(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Checkout');
            Home.init_listerns()
            
            
            
            console.log(qtModal)
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    getModalInserNewAddressUser(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Adicionar novo endereço');
            Home.init_listerns()
            
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    storageNewAddressUser(url,data){
        axios({
            url:url,
            method: 'POST',
            data: new FormData(data),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            
                swal(
                    'Sucesso!',
                    '',
                    'success'
                )
                setTimeout(() =>{
                    $('.announcementModalArea').fadeOut('slow')
                    let url = window.location.origin+ '/app/getModalCheckout'
                    Home.getModalCheckout(url)
                    swal.close()
                   
                },3000)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    sendOrderUser(url,data){
        axios({
            url:url,
            method: 'POST',
            data: new FormData(data),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            
                swal(
                    'Sucesso!',
                    '',
                    'success'
                )
                setTimeout(() =>{
                    $('.announcementModalArea').fadeOut('slow')
                    let url = window.location.origin+ '/app/getModalCheckout'
                    Home.getModalCheckout(url)
                    swal.close()
                   
                },3000)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    CheckoutUser(url,data){
        axios({
            url:url,
            method: 'POST',
            data: new FormData(data),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            
                swal(
                    'Sucesso!',
                    '',
                    'success'
                )
                setTimeout(() =>{
                    $('.announcementModalArea').fadeOut('slow')
                    Home.getTotalItemCart()
                    swal.close()
                    $("#modalMain").modal('hide');
                   
                },3000)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
}