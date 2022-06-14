
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
        $('.show-modal-login-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            let url = window.location.origin + '/app/getModalLoginUser'
            Home.getModalLoginUser(url)
        })
        $('.form-login-user').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin + '/app/loginUser?redirectURL='+window.location.href
            Home.loginUser(url, this)
        })
        $('.logout-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin +'/app/logoutUser?redirectURL='+window.location.href
            Home.logoutUser(url)
        })
        $('.my-bag').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin +'/app/getModalMyBagUser'
            Home.getModalMyBagUser(url);
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
            $('input[name="items[]"]').on('change', function(e){
                e.preventDefault();
                Home.sumValueAdditionalSelected()
            })
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    actionModalProduct(){
        let qtModal = 1;
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
            Home.sumValueAdditionalSelected(price_product_selected)
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
            if(idItemsAdditonal.length > 0){
                price = $('.final-price').html();
            }else{
                if($('.price-product-selected').length > 0){
                    price = $('.price-product-selected').html();
                }else{
                    price = $('input[name="priceCliente"]').val();
                }
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
                    observation: $('.observation-user').val(),
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
                    'Item adicionado ao carrinho!',
                    '',
                    'success'
                )
                $('.announcementModalArea').addClass('hidden')
                setTimeout(() =>{
                    
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
            
            //apply filter
            $('.phone_number').mask('(00)  0000-0000');
            $('.cep').mask('00000-000');
            Home.init_listerns()
            
            ;
            $('.checkbox-money').on('change', function(e) {
                e.stopImmediatePropagation()
                e.preventDefault();
               
                if ($(this).prop('checked')) {
                    $('.content-thing').fadeIn()
                        // $(this).attr('value', '1')
                        $('input[name="thing"]').mask("#,##0.00", {reverse: true})
                } else {
                    $('.content-thing').fadeOut();
                    // $(this).attr('value', '0')
                }
            })
            $('.checkbox-credcard').on('change', function(e) {
                e.stopImmediatePropagation()
                e.preventDefault();
               
                if ($(this).prop('checked')) {
                    // $(this).attr('value', '1')
                    $('.content-thing').fadeOut();
                    $('input[name="thing"]').attr('value', '0.00')
                } else {
                    $('.content-variation-area').fadeOut();
                    // $(this).attr('value', '0')
                }
            })
            $('#pick_up_on_the_spot-yes').on('change', function(e){
                e.preventDefault()
                if($(this).prop('checked')){
                    $('.content-info-delivery-price').fadeOut()
                }else{
                    $('.content-info-delivery-price').fadeOut();
                }
            })
            $('#pick_up_on_the_spot-no').on('change', function(e){
                e.preventDefault()
                if($(this).prop('checked')){
                    $('.content-info-delivery-price').fadeIn();
                }else{
                    $('.content-info-delivery-price').fadeOut();
                }
            })
            
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
                window.location.href = window.location.href
                setTimeout(() =>{
                    $('.announcementModalArea').fadeOut('slow')
                    Home.getTotalItemCart()
                    Ultils.getNotifyComapy();
                    swal.close()
                    $("#modalMain").modal('hide');
                    
                   
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
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .then((response) =>{
            
                swal(
                    'Compra Realizada!',
                    '',
                    'success'
                )
                
                setTimeout(() =>{
                    $("#modalMain").modal('hide');
                    swal.close()
                    window.location.href = window.location.href
                    Ultils.getNotifyComapy();
                   
                },2000)
               
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    getModalLoginUser(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Login');
            Home.init_listerns()
            $('.phone_number').mask('(00) 0 0000-0000');
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    loginUser(url,data){
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
                    'Estamos lhe Redicionando novamente!',
                    '',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    $("#modalMain").modal('hide');
                    window.location.href = window.location.href
                   
                },3000)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    logoutUser(url){
        axios({
            url:url,
            method: 'POST',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
            
                swal(
                    'Estamos lhe Redicionando novamente!',
                    '',
                    'success'
                )
                setTimeout(() =>{
                    swal.close()
                    $("#modalMain").modal('hide');
                    window.location.href = window.location.href
                   
                },3000)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    getModalMyBagUser(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Minha Sacola');
            Home.init_listerns()
            
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    sumValueAdditionalSelected(price_product_selected){
        var total = 0;
        let price_additiona = []
        let priceSelectedClient = 0
        let finalPrice = 0;
        if($('input[name="priceCliente"]').length > 0){
            priceSelectedClient = parseFloat($('input[name="priceCliente"]').val()) 
        }else{
            priceSelectedClient = parseFloat($('.price-product-selected').html())
           
        }

        $('input[name="items[]"]:checked').each(function(index, element){
            price_additiona.push({price: parseFloat($(this).attr('data-price_additional'))})
            
        }) 
        for (var i in price_additiona) {
            total += price_additiona[i].price;
        }

        $('.price_additional').html(total.toFixed(2))
        if($('input[name="priceCliente"]').length > 0){

            $('input[name="priceCliente"]').on('keyup',function(e){
                e.preventDefault()
                priceSelectedClient = parseFloat($('input[name="priceCliente"]').val()) 
                finalPrice = priceSelectedClient + parseFloat(total.toFixed(2))
                $('.final-price').html(finalPrice.toFixed(2))
            })
            
        }
        priceSelectedClient = (!isNaN( priceSelectedClient)) ? priceSelectedClient : 0;
        finalPrice = total + priceSelectedClient
        $('.final-price').html(finalPrice.toFixed(2))
    },
    
}