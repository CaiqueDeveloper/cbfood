const Orders = {

    construct(){
        Orders.getOrders()
    },
    init_listerns(){

    },
    getOrders(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method:'GET',
            url: window.location.origin + '/admin/getOrders'
        })
        .then((response) =>{
            let orders = []
            let itemsOrder = []
            
            for(let i in response.data){
                for(let e in response.data[i].order_product){
                    for(let a in response.data[i].order_product[e].product_order){
                        itemsOrder.push({
                            itemName: response.data[i].order_product[e].product_order[a].name,
                            itemPrice: response.data[i].order_product[e].price,
                            itemQuantity: response.data[i].order_product[e].quantity,
                            itemSizeText: response.data[i].order_product[e].sizeText,
                            itemObservation: response.data[i].order_product[e].observation,
                            itemAdditionalID: response.data[i].order_product[e].additional_id,
                        })
                    }
                    
                }
                orders.push({
                    orderCodId: response.data[i].id,
                    orderUserName: response.data[i].order_user[0].name,
                    orderTotalPrice: response.data[i].price_total,
                    orderPaymentMethod: response.data[i].payment_method,
                    orderDeliveryPrice: response.data[i].delivery_price,
                    orderThing: response.data[i].thing,
                    orderPickUpOnTheSpot: response.data[i].pickUpOnTheSpot,
                    orderStatus: response.data[i].status,
                    orderTotalItens: response.data[i].order_product.length,
                    orderAddressUserId: response.data[i].address_id,
                    orderDate: response.data[i].created_at,
                    itemsOrderuser: itemsOrder
                })
                itemsOrder = []
            }

            Orders.drawTableOrders(orders)
            Orders.delivered(orders)
            Orders.beingPrepared(orders)
            Orders.canceled(orders)
        })
        .catch((error) =>{
            console.log(error.response.data)
        }).finally(() => {$('.AppBlock').addClass('d-none');})
    }, 
    drawTableOrders(orders){
        //Create Colum
        var columns = [{
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
            title: 'EXPANDIR'
        },{
            data: "orderCodId",
            title: "CÓDIGO DO PEDIDO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "PEDIDO POR",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QT ITENS",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "FORMA DE PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR TOTAL",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        },{
            data: "orderPickUpOnTheSpot",
            title: "RETIRAR NO LOCAL?",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'SOLICTADO EM',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO DE ENTREGA',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS DO PEDIDO',
            className: 'text-center'
        }];
        //Mounted Table
        var table = $('.table-orders ').DataTable({
            destroy: true,
            columns: columns,
            data: orders,
            order: [
            [1, "desc"]
            ],
            drawCallback: function( settings ){
                $('.cancel-order, .to-recive-order, .being-prepared-order, .out-for-delivery-order, .delivered-order').on('click', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    let order_id = $(this).attr('value')
                    let status = $(this).attr('data-order_status')

                    let url = window.location.origin + `/admin/updateStatusOrder?order_id=${order_id}&status=${status}`
                    Orders.updateStatusOrder(url);
                })
                $('.exportOrder').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let order_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/exportOrder/'+order_id
                    Orders.exportOrder(url);
                })
                $('.show-modal-address').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let address_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/showModalAddressOrderUser/'+address_id
                    Orders.showModalAddressOrderUser(url);
                })
                
                
            },
            columnDefs: [{
                targets: 0,
                orderable: false,
                render: function(a, n, e, s) {
                    return '';
                }
            }, {
                targets: 1,
                orderable: false,
                render: function(a, n, e, s) {
                    return a+' #'
                }
            }, {
                targets: 2,
                orderable: false,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 3,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;;
                }
            }, {
                targets: 4,
                orderable: true,
                render: function(a, n, e, s) {
                    switch(a){
                        case 'credcard':
                            return  'Cartão de Crédito'    
                        break;
                        case 'money':
                            return 'Em Dinheiro'    
                        break;
                    }
                }
            }, {
                targets: 5,
                orderable: true,
                render: function(a, n, e, s) {
                    return Ultils.formatMoney(a)
                }
            }, {
                targets: 6,
                orderable: true,
                render: function(a, n, e, s) {
                    if(a !=  null){
                        return Ultils.formatMoney(a)
                    }else{
                       return 'TROCO NÃO INFORMADO';
                    }
                }
            }, {
                targets: 7,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 8,
                orderable: true,
                render: function(a, n, e, s) {
                   switch(a){
                       case 0:
                            return '<p style="background:#fca5a5; color:#dc2626;border-radius:20px;font-weight:bold;" >CANCELADO</p>'    
                       break;
                       case 1:
                            return '<p style="background:#93c5fd; color:#2563eb;border-radius:20px;font-weight:bold;">NOVO</p>'   
                       break;
                       case 2:
                            return '<p style="background:#6ee7b7; color:#059669;border-radius:20px;font-weight:bold">RECEBIDO</p>'     
                       break;
                       case 3:
                            return '<p style="background:#fde047; color:#ca8a04;border-radius:20px;font-weight:bold">SENDO PREPARADO</p>'    
                       break;
                       case 4:
                        return '<p style="background:#5eead4; color:#0d9488;border-radius:20px;font-weight:bold">SAIU PARA ENTREGA</p>'     
                       break;
                       case 5:
                        return '<p style="background:#86efac; color:#16a34a;border-radius:20px;font-weight:bold">ENTREGUE</p>'     
                       break;
                   }
                }
            }, {
                targets: 9,
                orderable: true,
                render: function(a, n, e, s) {
                    return moment(a.orderDate).format('DD/MM/YYYY');   ;
                }
            }, {
                targets: 10,
                orderable: true,
                render: function(a, n, e, s) {
                    return `<a href="#" class="show-modal-address" value="${a}" style="color:#2563eb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    </a>`;
                }
            }, {
                targets: 11,
                orderable: true,
                render: function(a, n, e, s) {
                    
                    return `
                    
                    <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-stoplights" viewBox="0 0 16 16">
                            <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1.5 2.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M4 2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v1a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-1c-1.2-.4-1.833-1.5-2-2h2V8c-1.2-.4-1.833-1.5-2-2h2V4c-1.2-.4-1.833-1.5-2-2h2zm2-1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item cancel-order" href="#" data-order_status="0" value="${a}">CANCELADO</a>
                      <a class="dropdown-item to-recive-order" href="#" data-order_status="2" value="${a}">RECEBIDO</a>
                      <a class="dropdown-item being-prepared-order" href="#" data-order_status="3" value="${a}">SENDO PREPARADO</a>
                      <a class="dropdown-item out-for-delivery-order" href="#" data-order_status="4" value="${a}">SAIU PARA ENTREGA</a>
                      <a class="dropdown-item delivered-order" href="#" data-order_status="5" value="${a}">ENTREGUE</a>
                      <a class="dropdown-item exportOrder" href="#" data-order_status="5" value="${a}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                    `;
                }
            }]
        });
         
        // Add event listener for opening and closing details
        $('.table-orders tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
     
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
            $('.show-modal-additional').on('click', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                
                let additional_id = $(this).attr('data-additionals_id')
                let url = window.location.origin + '/admin/showModalGerAdditionalOrders'
                Orders.showModalGerAdditionalOrders(url, additional_id);
            })
        });
        //Creating sub children table
        function format(d) {
            
            let row = ''
            let size = ''
            let obs = ''
            let additionals = ''
           for(let i in d.itemsOrderuser){
            size =  ( d.itemsOrderuser[i].itemSizeText != '') ? d.itemsOrderuser[i].itemSizeText : 'NÃO ESPECIFICADO'
            obs =  ( d.itemsOrderuser[i].itemObservation != null) ? d.itemsOrderuser[i].itemObservation : 'NÃO ESPECIFICADO'
            additionals =  (d.itemsOrderuser[i].itemAdditionalID != '') ? `<a href="#" class="show-modal-additional" data-additionals_id="${d.itemsOrderuser[i].itemAdditionalID}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
            </a>` : 'NÃO '
            row +=    `
                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div class="nama col text-sm font-bold">Item: ${d.itemsOrderuser[i].itemName} </div>
                    <div class="nama col text-sm font-bold">Qt: ${d.itemsOrderuser[i].itemQuantity}</div>
                    <div class="nama col text-sm font-bold">Valor R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
                    <div class="nama col text-sm font-bold">Tamanho: ${size}</div>
                    <div class="nama col text-sm font-bold">Observações: ${obs}</div>
                    <div class="nama col text-sm font-bold">TEM ADICIONAIS: ${additionals}</div>
                    
                    </div>
                </div>
                `
          }
          return row;
        } 
    },
    updateStatusOrder(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:url,
            method: 'GET'
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
                    Orders.getOrders()
                },3000)
            }
        })
        .catch((error) =>{
            
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');});
    },
    delivered(orders){
       
        let deliveredOrders = [];
        for(let i in orders){
            if(orders[i].orderStatus == 5){
                deliveredOrders.push( orders[i])
                
                
            }
        }
        console.log(deliveredOrders)
        //Create Colum
        var columns = [{
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
            title: 'EXPANDIR'
        },{
            data: "orderCodId",
            title: "CÓDIGO DO PEDIDO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "PEDIDO POR",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QT ITENS",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "FORMA DE PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR TOTAL",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'SOLICTADO EM',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO DE ENTREGA',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS DO PEDIDO',
            className: 'text-center'
        }];
        //Mounted Table
        var table = $('.table-orders-delivered').DataTable({
            destroy: true,
            columns: columns,
            data: deliveredOrders,
            order: [
            [1, "desc"]
            ],
            drawCallback: function( settings ){
                $('.cancel-order, .to-recive-order, .being-prepared-order, .out-for-delivery-order, .delivered-order').on('click', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    let order_id = $(this).attr('value')
                    let status = $(this).attr('data-order_status')

                    let url = window.location.origin + `/admin/updateStatusOrder?order_id=${order_id}&status=${status}`
                    Orders.updateStatusOrder(url);
                })
                $('.exportOrder').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let order_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/exportOrder/'+order_id
                    Orders.exportOrder(url);
                })
                $('.show-modal-address').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let address_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/showModalAddressOrderUser/'+address_id
                    Orders.showModalAddressOrderUser(url);
                })
                
                
            },
            columnDefs: [{
                targets: 0,
                orderable: false,
                render: function(a, n, e, s) {
                    return '';
                }
            }, {
                targets: 1,
                orderable: false,
                render: function(a, n, e, s) {
                    return a+' #'
                }
            }, {
                targets: 2,
                orderable: false,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 3,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;;
                }
            }, {
                targets: 4,
                orderable: true,
                render: function(a, n, e, s) {
                    switch(a){
                        case 'credcard':
                            return  'Cartão de Crédito'    
                        break;
                        case 'money':
                            return 'Em Dinheiro'    
                        break;
                    }
                }
            }, {
                targets: 5,
                orderable: true,
                render: function(a, n, e, s) {
                    return Ultils.formatMoney(a)
                }
            }, {
                targets: 6,
                orderable: true,
                render: function(a, n, e, s) {
                    if(a !=  null){
                        return Ultils.formatMoney(a)
                    }else{
                       return 'TROCO NÃO INFORMADO';
                    }
                }
            }, {
                targets: 7,
                orderable: true,
                render: function(a, n, e, s) {
                   switch(a){
                       case 0:
                            return '<p style="background:#fca5a5; color:#dc2626;border-radius:20px;font-weight:bold;" >CANCELADO</p>'    
                       break;
                       case 1:
                            return '<p style="background:#93c5fd; color:#2563eb;border-radius:20px;font-weight:bold;">NOVO</p>'   
                       break;
                       case 2:
                            return '<p style="background:#6ee7b7; color:#059669;border-radius:20px;font-weight:bold">RECEBIDO</p>'     
                       break;
                       case 3:
                            return '<p style="background:#fde047; color:#ca8a04;border-radius:20px;font-weight:bold">SENDO PREPARADO</p>'    
                       break;
                       case 4:
                        return '<p style="background:#5eead4; color:#0d9488;border-radius:20px;font-weight:bold">SAIU PARA ENTREGA</p>'     
                       break;
                       case 5:
                        return '<p style="background:#86efac; color:#16a34a;border-radius:20px;font-weight:bold">ENTREGUE</p>'     
                       break;
                   }
                }
            }, {
                targets: 8,
                orderable: true,
                render: function(a, n, e, s) {
                    return moment(a.orderDate).format('DD/MM/YYYY');   ;
                }
            }, {
                targets: 9,
                orderable: true,
                render: function(a, n, e, s) {
                    return `<a href="#" class="show-modal-address" value="${a}" style="color:#2563eb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    </a>`;
                }
            }, {
                targets: 10,
                orderable: true,
                render: function(a, n, e, s) {
                    
                    return `
                    
                    <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-stoplights" viewBox="0 0 16 16">
                            <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1.5 2.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M4 2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v1a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-1c-1.2-.4-1.833-1.5-2-2h2V8c-1.2-.4-1.833-1.5-2-2h2V4c-1.2-.4-1.833-1.5-2-2h2zm2-1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item cancel-order" href="#" data-order_status="0" value="${a}">CANCELADO</a>
                      <a class="dropdown-item to-recive-order" href="#" data-order_status="2" value="${a}">RECEBIDO</a>
                      <a class="dropdown-item being-prepared-order" href="#" data-order_status="3" value="${a}">SENDO PREPARADO</a>
                      <a class="dropdown-item out-for-delivery-order" href="#" data-order_status="4" value="${a}">SAIU PARA ENTREGA</a>
                      <a class="dropdown-item delivered-order" href="#" data-order_status="5" value="${a}">ENTREGUE</a>
                      <a class="dropdown-item exportOrder" href="#" data-order_status="5" value="${a}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                    `;
                }
            }]
        });
         
        // Add event listener for opening and closing details
        $('.table-orders-delivered tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
     
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
            $('.show-modal-additional').on('click', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                
                let additional_id = $(this).attr('data-additionals_id')
                let url = window.location.origin + '/admin/showModalGerAdditionalOrders'
                Orders.showModalGerAdditionalOrders(url, additional_id);
            })
        });
        //Creating sub children table
        function format(d) {
            
            let row = ''
            let size = ''
            let obs = ''
            let additionals = ''
           for(let i in d.itemsOrderuser){
            size =  ( d.itemsOrderuser[i].itemSizeText != '') ? d.itemsOrderuser[i].itemSizeText : 'NÃO ESPECIFICADO'
            obs =  ( d.itemsOrderuser[i].itemObservation != null) ? d.itemsOrderuser[i].itemObservation : 'NÃO ESPECIFICADO'
            additionals =  (d.itemsOrderuser[i].itemAdditionalID != '') ? `<a href="#" class="show-modal-additional" data-additionals_id="${d.itemsOrderuser[i].itemAdditionalID}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
            </a>` : 'NÃO '
            row +=    `
                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div class="nama col text-sm font-bold">Item: ${d.itemsOrderuser[i].itemName} </div>
                    <div class="nama col text-sm font-bold">Qt: ${d.itemsOrderuser[i].itemQuantity}</div>
                    <div class="nama col text-sm font-bold">Valor R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
                    <div class="nama col text-sm font-bold">Tamanho: ${size}</div>
                    <div class="nama col text-sm font-bold">Observações: ${obs}</div>
                    <div class="nama col text-sm font-bold">TEM ADICIONAIS: ${additionals}</div>
                    
                    </div>
                </div>
                `
          }
          return row;
        } 
    },
    beingPrepared(orders){
       
        let beingPreparedOrders = [];
        for(let i in orders){
            if(orders[i].orderStatus == 3){
                beingPreparedOrders.push( orders[i])
                
                
            }
        }
        console.log(beingPreparedOrders)
        //Create Colum
        var columns = [{
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
            title: 'EXPANDIR'
        },{
            data: "orderCodId",
            title: "CÓDIGO DO PEDIDO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "PEDIDO POR",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QT ITENS",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "FORMA DE PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR TOTAL",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'SOLICTADO EM',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO DE ENTREGA',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS DO PEDIDO',
            className: 'text-center'
        }];
        //Mounted Table
        var table = $('.table-orders-being-prepared ').DataTable({
            destroy: true,
            columns: columns,
            data: beingPreparedOrders,
            order: [
            [1, "desc"]
            ],
            drawCallback: function( settings ){
                $('.cancel-order, .to-recive-order, .being-prepared-order, .out-for-delivery-order, .delivered-order').on('click', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    let order_id = $(this).attr('value')
                    let status = $(this).attr('data-order_status')

                    let url = window.location.origin + `/admin/updateStatusOrder?order_id=${order_id}&status=${status}`
                    Orders.updateStatusOrder(url);
                })
                $('.exportOrder').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let order_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/exportOrder/'+order_id
                    Orders.exportOrder(url);
                })
                $('.show-modal-address').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let address_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/showModalAddressOrderUser/'+address_id
                    Orders.showModalAddressOrderUser(url);
                })
                
                
            },
            columnDefs: [{
                targets: 0,
                orderable: false,
                render: function(a, n, e, s) {
                    return '';
                }
            }, {
                targets: 1,
                orderable: false,
                render: function(a, n, e, s) {
                    return a+' #'
                }
            }, {
                targets: 2,
                orderable: false,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 3,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;;
                }
            }, {
                targets: 4,
                orderable: true,
                render: function(a, n, e, s) {
                    switch(a){
                        case 'credcard':
                            return  'Cartão de Crédito'    
                        break;
                        case 'money':
                            return 'Em Dinheiro'    
                        break;
                    }
                }
            }, {
                targets: 5,
                orderable: true,
                render: function(a, n, e, s) {
                    return Ultils.formatMoney(a)
                }
            }, {
                targets: 6,
                orderable: true,
                render: function(a, n, e, s) {
                    if(a !=  null){
                        return Ultils.formatMoney(a)
                    }else{
                       return 'TROCO NÃO INFORMADO';
                    }
                }
            }, {
                targets: 7,
                orderable: true,
                render: function(a, n, e, s) {
                   switch(a){
                       case 0:
                            return '<p style="background:#fca5a5; color:#dc2626;border-radius:20px;font-weight:bold;" >CANCELADO</p>'    
                       break;
                       case 1:
                            return '<p style="background:#93c5fd; color:#2563eb;border-radius:20px;font-weight:bold;">NOVO</p>'   
                       break;
                       case 2:
                            return '<p style="background:#6ee7b7; color:#059669;border-radius:20px;font-weight:bold">RECEBIDO</p>'     
                       break;
                       case 3:
                            return '<p style="background:#fde047; color:#ca8a04;border-radius:20px;font-weight:bold">SENDO PREPARADO</p>'    
                       break;
                       case 4:
                        return '<p style="background:#5eead4; color:#0d9488;border-radius:20px;font-weight:bold">SAIU PARA ENTREGA</p>'     
                       break;
                       case 5:
                        return '<p style="background:#86efac; color:#16a34a;border-radius:20px;font-weight:bold">ENTREGUE</p>'     
                       break;
                   }
                }
            }, {
                targets: 8,
                orderable: true,
                render: function(a, n, e, s) {
                    return moment(a.orderDate).format('DD/MM/YYYY');   ;
                }
            }, {
                targets: 9,
                orderable: true,
                render: function(a, n, e, s) {
                    return `<a href="#" class="show-modal-address" value="${a}" style="color:#2563eb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    </a>`;
                }
            }, {
                targets: 10,
                orderable: true,
                render: function(a, n, e, s) {
                    
                    return `
                    
                    <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-stoplights" viewBox="0 0 16 16">
                            <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1.5 2.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M4 2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v1a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-1c-1.2-.4-1.833-1.5-2-2h2V8c-1.2-.4-1.833-1.5-2-2h2V4c-1.2-.4-1.833-1.5-2-2h2zm2-1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item cancel-order" href="#" data-order_status="0" value="${a}">CANCELADO</a>
                      <a class="dropdown-item to-recive-order" href="#" data-order_status="2" value="${a}">RECEBIDO</a>
                      <a class="dropdown-item being-prepared-order" href="#" data-order_status="3" value="${a}">SENDO PREPARADO</a>
                      <a class="dropdown-item out-for-delivery-order" href="#" data-order_status="4" value="${a}">SAIU PARA ENTREGA</a>
                      <a class="dropdown-item delivered-order" href="#" data-order_status="5" value="${a}">ENTREGUE</a>
                      <a class="dropdown-item exportOrder" href="#" data-order_status="5" value="${a}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                    `;
                }
            }]
        });
         
        // Add event listener for opening and closing details
        $('.table-orders-being-prepared tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
     
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
            $('.show-modal-additional').on('click', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                
                let additional_id = $(this).attr('data-additionals_id')
                let url = window.location.origin + '/admin/showModalGerAdditionalOrders'
                Orders.showModalGerAdditionalOrders(url, additional_id);
            })
        });
        //Creating sub children table
        function format(d) {
            
            let row = ''
            let size = ''
            let obs = ''
            let additionals = ''
           for(let i in d.itemsOrderuser){
            size =  ( d.itemsOrderuser[i].itemSizeText != '') ? d.itemsOrderuser[i].itemSizeText : 'NÃO ESPECIFICADO'
            obs =  ( d.itemsOrderuser[i].itemObservation != null) ? d.itemsOrderuser[i].itemObservation : 'NÃO ESPECIFICADO'
            additionals =  (d.itemsOrderuser[i].itemAdditionalID != '') ? `<a href="#" class="show-modal-additional" data-additionals_id="${d.itemsOrderuser[i].itemAdditionalID}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
            </a>` : 'NÃO '
            row +=    `
                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div class="nama col text-sm font-bold">Item: ${d.itemsOrderuser[i].itemName} </div>
                    <div class="nama col text-sm font-bold">Qt: ${d.itemsOrderuser[i].itemQuantity}</div>
                    <div class="nama col text-sm font-bold">Valor R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
                    <div class="nama col text-sm font-bold">Tamanho: ${size}</div>
                    <div class="nama col text-sm font-bold">Observações: ${obs}</div>
                    <div class="nama col text-sm font-bold">TEM ADICIONAIS: ${additionals}</div>
                    
                    </div>
                </div>
                `
          }
          return row;
        }
    },
    canceled(orders){
       
        let canceledOrders = [];
        for(let i in orders){
            if(orders[i].orderStatus == 0){
                canceledOrders.push( orders[i])
                
                
            }
        }
        console.log(canceledOrders)
        //Create Colum
        var columns = [{
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
            title: 'EXPANDIR'
        },{
            data: "orderCodId",
            title: "CÓDIGO DO PEDIDO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "PEDIDO POR",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QT ITENS",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "FORMA DE PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR TOTAL",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'SOLICTADO EM',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO DE ENTREGA',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS DO PEDIDO',
            className: 'text-center'
        }];
        //Mounted Table
        var table = $('.table-orders-canceled ').DataTable({
            destroy: true,
            columns: columns,
            data: canceledOrders,
            order: [
            [1, "desc"]
            ],
            drawCallback: function( settings ){
                $('.cancel-order, .to-recive-order, .being-prepared-order, .out-for-delivery-order, .delivered-order').on('click', function(e){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    let order_id = $(this).attr('value')
                    let status = $(this).attr('data-order_status')

                    let url = window.location.origin + `/admin/updateStatusOrder?order_id=${order_id}&status=${status}`
                    Orders.updateStatusOrder(url);
                })
                $('.exportOrder').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let order_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/exportOrder/'+order_id
                    Orders.exportOrder(url);
                })
                $('.show-modal-address').on('click', function(e){
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let address_id = $(this).attr('value')
                    let url = window.location.origin + '/admin/showModalAddressOrderUser/'+address_id
                    Orders.showModalAddressOrderUser(url);
                })
                
                
            },
            columnDefs: [{
                targets: 0,
                orderable: false,
                render: function(a, n, e, s) {
                    return '';
                }
            }, {
                targets: 1,
                orderable: false,
                render: function(a, n, e, s) {
                    return a+' #'
                }
            }, {
                targets: 2,
                orderable: false,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 3,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;;
                }
            }, {
                targets: 4,
                orderable: true,
                render: function(a, n, e, s) {
                    switch(a){
                        case 'credcard':
                            return  'Cartão de Crédito'    
                        break;
                        case 'money':
                            return 'Em Dinheiro'    
                        break;
                    }
                }
            }, {
                targets: 5,
                orderable: true,
                render: function(a, n, e, s) {
                    return Ultils.formatMoney(a)
                }
            }, {
                targets: 6,
                orderable: true,
                render: function(a, n, e, s) {
                    if(a !=  null){
                        return Ultils.formatMoney(a)
                    }else{
                       return 'TROCO NÃO INFORMADO';
                    }
                }
            }, {
                targets: 7,
                orderable: true,
                render: function(a, n, e, s) {
                   switch(a){
                       case 0:
                            return '<p style="background:#fca5a5; color:#dc2626;border-radius:20px;font-weight:bold;" >CANCELADO</p>'    
                       break;
                       case 1:
                            return '<p style="background:#93c5fd; color:#2563eb;border-radius:20px;font-weight:bold;">NOVO</p>'   
                       break;
                       case 2:
                            return '<p style="background:#6ee7b7; color:#059669;border-radius:20px;font-weight:bold">RECEBIDO</p>'     
                       break;
                       case 3:
                            return '<p style="background:#fde047; color:#ca8a04;border-radius:20px;font-weight:bold">SENDO PREPARADO</p>'    
                       break;
                       case 4:
                        return '<p style="background:#5eead4; color:#0d9488;border-radius:20px;font-weight:bold">SAIU PARA ENTREGA</p>'     
                       break;
                       case 5:
                        return '<p style="background:#86efac; color:#16a34a;border-radius:20px;font-weight:bold">ENTREGUE</p>'     
                       break;
                   }
                }
            }, {
                targets: 8,
                orderable: true,
                render: function(a, n, e, s) {
                    return moment(a.orderDate).format('DD/MM/YYYY');   ;
                }
            }, {
                targets: 9,
                orderable: true,
                render: function(a, n, e, s) {
                    return `<a href="#" class="show-modal-address" value="${a}" style="color:#2563eb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    </a>`;
                }
            }, {
                targets: 10,
                orderable: true,
                render: function(a, n, e, s) {
                    
                    return `
                    
                    <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-stoplights" viewBox="0 0 16 16">
                            <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm0 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1.5 2.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M4 2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v2h2c-.167.5-.8 1.6-2 2v1a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-1c-1.2-.4-1.833-1.5-2-2h2V8c-1.2-.4-1.833-1.5-2-2h2V4c-1.2-.4-1.833-1.5-2-2h2zm2-1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item cancel-order" href="#" data-order_status="0" value="${a}">CANCELADO</a>
                      <a class="dropdown-item to-recive-order" href="#" data-order_status="2" value="${a}">RECEBIDO</a>
                      <a class="dropdown-item being-prepared-order" href="#" data-order_status="3" value="${a}">SENDO PREPARADO</a>
                      <a class="dropdown-item out-for-delivery-order" href="#" data-order_status="4" value="${a}">SAIU PARA ENTREGA</a>
                      <a class="dropdown-item delivered-order" href="#" data-order_status="5" value="${a}">ENTREGUE</a>
                      <a class="dropdown-item exportOrder" href="#" data-order_status="5" value="${a}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        </svg>
                      </a>
                    </div>
                  </div>
                    `;
                }
            }]
        });
         
        // Add event listener for opening and closing details
        $('.table-orders-canceled tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
     
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
            $('.show-modal-additional').on('click', function(e){
                e.preventDefault()
                e.stopImmediatePropagation()
                
                let additional_id = $(this).attr('data-additionals_id')
                let url = window.location.origin + '/admin/showModalGerAdditionalOrders'
                Orders.showModalGerAdditionalOrders(url, additional_id);
            })
        });
        //Creating sub children table
        function format(d) {
            
            let row = ''
            let size = ''
            let obs = ''
            let additionals = ''
           for(let i in d.itemsOrderuser){
            size =  ( d.itemsOrderuser[i].itemSizeText != '') ? d.itemsOrderuser[i].itemSizeText : 'NÃO ESPECIFICADO'
            obs =  ( d.itemsOrderuser[i].itemObservation != null) ? d.itemsOrderuser[i].itemObservation : 'NÃO ESPECIFICADO'
            additionals =  (d.itemsOrderuser[i].itemAdditionalID != '') ? `<a href="#" class="show-modal-additional" data-additionals_id="${d.itemsOrderuser[i].itemAdditionalID}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
            </svg>
            </a>` : 'NÃO '
            row +=    `
                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div class="nama col text-sm font-bold">Item: ${d.itemsOrderuser[i].itemName} </div>
                    <div class="nama col text-sm font-bold">Qt: ${d.itemsOrderuser[i].itemQuantity}</div>
                    <div class="nama col text-sm font-bold">Valor R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
                    <div class="nama col text-sm font-bold">Tamanho: ${size}</div>
                    <div class="nama col text-sm font-bold">Observações: ${obs}</div>
                    <div class="nama col text-sm font-bold">TEM ADICIONAIS: ${additionals}</div>
                    
                    </div>
                </div>
                `
          }
          return row;
        }
    },
    exportOrder(url){
        $('.AppBlock').removeClass('d-none');
        axios({
            url: url,
            method: 'GET'
        }).then((response) => {
            console.log(response.data)
            window.open(url, '_blank');
        }).catch((error) => {
            console.log(error.response.data);
        }).finally(()=>{$('.AppBlock').addClass('d-none');})
    },
    showModalAddressOrderUser(url){
        axios({
            method: 'GET',
            url: url
        }).then((response) =>{

            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Endereço de Entrega');

        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(() => {
            console.log('finalizou a consulta..')
        })
    },
    showModalGerAdditionalOrders(url, additional_id){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: url,
            params:{id:additional_id}
        }).then((response) =>{

            $("#modalMain").find('.modal-body').html(response.data);
            $('#modalMain').modal('show');
            $('.modal-dialog').addClass('modal-lg');
            $('.modal-title').html('Endereço de Entrega');

        }).catch((error)=>{
            console.log(error.response.data)
        }).finally(() => {
            $('.AppBlock').addClass('d-none');
        })
    },
    
}