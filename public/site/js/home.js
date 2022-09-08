
var Home = {

    constructor() {
        
        Home.init_listerns()
        Home.getTotalItemCart()
        Home.getTotalPriceItemCart()
        Home.rederViewAllProductsCompany()
        $('.search-product').on('submit', function(e){
            e.preventDefault()
            let productName = $(this).val()
            let company_id = $(this).attr('data-company_id')

            let url = window.location.origin + `/app/getProductName`
            Home.getProductName(url, this)
        }) 
        var btn = $('#toTop');
        $(window).scroll(function() {
            if ($(this).scrollTop() - 200 > 0) {
                $('#toTop').stop().slideDown('fast'); // show the button
            } else {
                $('#toTop').stop().slideUp('fast'); // hide the button
            }
        });
        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop:0}, '300');
        });
        $('.show-modal-user').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url =  window.location.origin +  '/app/getModalUser'
            Home.getModalUser(url);
        })
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
            Home.updateItemCart(url, null);
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
        $('.user-folks').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/updateUserFolks'
            Home.updateUserFolks(url, this);
        })
        $('.user-change-password').on('submit', function(e){
            e.preventDefault()
            e.stopImmediatePropagation();
            let url = window.location.origin + '/admin/userChangePassword'
            Home.userChangePassword(url, this);
        })
        $('.my-bag').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let url = window.location.origin +'/app/getModalMyBagUser'
            Home.getModalMyBagUser(url);
        })
        $('.desabled-order').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            let order_id = $(this).attr('value')
            let status = 0

            let url = window.location.origin + `/admin/updateStatusOrder?order_id=${order_id}&status=${status}`
            Home.updateStatusOrder(url);
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
    rederViewAllProductsCompany(page = null){
       

        let slug = window.location.pathname.replace('/app/menu/', '');
        let url = '';

        if(page == null){
            url = window.location.origin + '/app/rederViewAllProductsCompany/'+slug
        }else{
            url = window.location.origin + '/app/rederViewAllProductsCompany/'+slug+'?page='+page
        }

        $('.AppBlock').removeClass('d-none');
        axios({
            url: url,
            method:'GET'
        }).then((response) =>{
            
            $('.reder-view-all-products-company').html(response.data.view)
           
            Home.init_listerns()
        }).catch((error) =>{

        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    updateUserFolks(url, data){
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
                    $("#modalMain").modal('hide');
                },3000)
            }
        })
    },
    userChangePassword(url, data){
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
                    
                    $("#modalMain").modal('hide');
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
    getProductName(url, data){
        
        $('.AppBlock').removeClass('d-none');
        axios({
            url: url,
            method:'POST',
            data: new FormData(data),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        }).then((response) =>{
           
            if(response.data.status == 200){
                $('.reder-view-all-products-company').html(response.data.view)
            }else{
                $('.reder-view-all-products-company').html(`
                <div class="mx-auto w-[80%] mt-4">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Opss !</strong> Não encontramos não um registro para essa pesquisa.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                `)
            }
            Home.init_listerns()
        }).catch((error) =>{
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
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

            $('.product-content-info-size').removeClass($(this).attr('data-bgColorItemSelect'))
            $(this).addClass($(this).attr('data-bgColorItemSelect'))
            let price_product_selected = $(this).attr('data-price_variation_product')
            $('.price-product-selected').html(price_product_selected)
            Home.sumValueAdditionalSelected(price_product_selected)
        })
        $('.product-content-info--qt').html(qtModal);

        //Action Add Cart Item
        $('.add-cart').on('click', function(e){
            e.preventDefault();

            let identifier =$(this).attr('data-product_id')+'@'+$('.product-content-info-size.'+$(this).attr('data-bgColorItemSelect')).attr('data-variation_id')
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
                    sizeId:  $('.product-content-info-size.'+$(this).attr('data-bgColorItemSelect')).attr('data-variation_id'),
                    sizeText:  $('.product-content-info-size.'+$(this).attr('data-bgColorItemSelect')).html(),
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
                    'Item adicionado!',
                    '',
                    'success'
                )
                $('.announcementModalArea').addClass('hidden')
                setTimeout(() =>{
                    
                    Home.getTotalItemCart()
                    Home.getTotalPriceItemCart()
                    swal.close()
                   
                },1500)
            
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
            Home.init_listerns()
            let qtModal = 1;
            $('.product-content-info--qt').html(qtModal);
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    getModalUser(url){
        axios({
            url:url,
            method:'GET'
        }).then((response) =>{
            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            Home.init_listerns()
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
                            Home.getTotalPriceItemCart()
                            $("#modalMain").modal('hide');
                        },1500)
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
                            Home.getTotalPriceItemCart()
                            let url = window.location.origin + '/app/getModalCartItem'
                            Home.getModalCartItem(url)
                            $("#modalMain").modal('hide');
                        },1500)
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
    getTotalPriceItemCart(){
        axios({
            url:window.location.origin + '/app/cart/totalPriceCartItem',
            method:'GET'
        }).then((response) =>{
            console.log(response.data)
            $('.total-priceIntemCart').html(`R$ ${response.data}` );
            
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    updateItemCart(url, identifier){
        axios({
            url:url,
            method: 'GET',
        })
        .then((response) =>{
            let url = window.location.origin + '/app/getModalCartItem'
            Home.getModalCartItem(url)
            Home.getTotalPriceItemCart()
            $('.total-price').html(`Total R$ ${response.data.totalPrice}`);
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
               //apply filter
               $('.phone_number').mask('(00)  0000-0000');
               let cep = $('.cep').mask('00000-000');
               Home.init_listerns()
               Ultils.getAddresBasedCep()
            
        }).catch((error) =>{

        }).finally(()=>{
            console.log('finalizou a consulta')
        })
    },
    storageNewAddressUser(url,data){
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
                   
                },1500)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    sendOrderUser(url,data){
        //console.log(data)
        axios({
            url:url,
            method: 'POST',
            data: new FormData(data),
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then((response) =>{
                console.log(response.data);
                swal(
                    'Sucesso!',
                    '',
                    'success'
                )
                //window.location.href = window.location.href
                setTimeout(() =>{
                    $('.announcementModalArea').fadeOut('slow')
                    Home.getTotalItemCart()
                    Home.getTotalPriceItemCart()
                    Ultils.getNotifyComapy();
                    Home.sendMessage(response.data)
                    swal.close()
                    $("#modalMain").modal('hide');
                },1500)
            
        })
        .catch((error) =>{
           
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    sendMessage(data){
            console.log(data.message.client);
            let prod = "";
            let addc = "";
            if(data.message.additionals[0] == "Não especificado"){
                addc = data.message.additionals[0]
            }else{
                for(var i in data.message.additionals){
                    addc =  data.message.additionals[i]+"\n"
                }
            }
            for(var i in data.message.products){
                prod += data.message.products[i]+"\n";
            }
            var bodyUrl = `*Reseumo do Pedido*\n\n*Código:* ${data.message.cod}\n*Cliente:* ${data.message.client}\n*Data do Pedido:* ${data.message.dateSolicitation}\n*F Pagamento:* ${data.message.paymentMethod}\n*Contato:* ${data.message.phone}\n*Valor Total:* ${data.message.priceOrder}\n\n*Produtos*\n ${prod}\n*Adicionais*\n${addc}\n\n*Endereço de Entega*\n*Cidade:* ${data.message.address.city}\n*Estado:* ${data.message.address.states}\n*Cep:* ${data.message.address.zipe_code}\n*Bairro* ${data.message.address.distric}\n*Rua* ${data.message.address.road}\n*Nª:* ${data.message.address.number}\n*Compemento* ${data.message.address.complement}`;
       
        console.log(bodyUrl)
        let isMobile = (function(a) {
            if ( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)) ) {
                return true
            } else {
                return false
            
            }
        })(navigator.userAgent || navigator.vendor || window.opera)
    
        if ( isMobile ) {
            let target = `whatsapp://send?phone=${data.message.whatapp}&text=${window.encodeURIComponent(bodyUrl)}`
            window.open(target,'_blank')
        } else {
            let target = `https://api.whatsapp.com/send?phone=${data.message.whatapp}&text=${window.encodeURIComponent(bodyUrl)}`
            window.open(target,'_blank')
        }
          
    },
    CheckoutUser(url,data){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:url,
            method: 'POST',
            data: new FormData(data),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .then((response) =>{
           // console.log(response.data.order.original)
                swal(
                    'Compra Realizada!',
                    '',
                    'success'
                )
                
                setTimeout(() =>{
                    $("#modalMain").modal('hide');
                    swal.close()
                    // window.location.href = window.location.href
                    Home.sendMessage(response.data.order.original)
                    Ultils.getNotifyComapy();
                    Home.getTotalItemCart()
                    Home.getTotalPriceItemCart()
                   
                   
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
                   
                },1500)
            
        })
        .catch((error) =>{
           $('.alert').removeClass('hidden')
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
                   
                },1500)
            
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
    updateStatusOrder(url){
        swal({
            title: 'Tem certeza que deseja cancelar esse pedido?',
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
                })
                .then((response) =>{
                    if(response.data){
                        swal(
                            'Sucesso!',
                            'Pedido Cancelado com sucesso',
                            'success'
                        )
                        setTimeout(() =>{
                            swal.close()
                            $("#modalMain").modal('hide');
                        },1500)
                    }
                })
                .catch((error) =>{
                })
                .finally(() =>{$('.AppBlock').addClass('d-none');});
            }
        });
    },
    
}