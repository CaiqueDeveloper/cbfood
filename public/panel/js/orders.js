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
            title: "CÓDIGO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "CLIENTE",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QUANTIDADE",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        },{
            data: "orderPickUpOnTheSpot",
            title: "RETIRAR?",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'DATA',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS',
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
            <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center" style="color: #14195a;font-weight: bold;">
                <div class="nama col text-sm font-bold">PRODUTO: ${d.itemsOrderuser[i].itemName} </div>
                <div class="nama col text-sm font-bold">QT: ${d.itemsOrderuser[i].itemQuantity}</div>
                <div class="nama col text-sm font-bold">VALOR R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
                <div class="nama col text-sm font-bold">TAMANHO: ${size}</div>
                <div class="nama col text-sm font-bold">OBSERVAÇÕES: ${obs}</div>
                <div class="nama col text-sm font-bold">ADICIONAIS: ${additionals}</div>
                
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
                    'Status atualizado com sucesso.',
                    'success'
                );
                setTimeout(() =>{
                    swal.close()
                    Orders.getOrders()
                    Orders.sendMessage(response.data)
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
            title: "CÓDIGO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "CLIENTE",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QUANTIDADE",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        },{
            data: "orderPickUpOnTheSpot",
            title: "RETIRAR?",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'DATA',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS',
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
                <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center" style="color: #14195a;font-weight: bold;">
                    <div class="nama col text-sm font-bold">PRODUTO: ${d.itemsOrderuser[i].itemName} </div>
                    <div class="nama col text-sm font-bold">QT: ${d.itemsOrderuser[i].itemQuantity}</div>
                    <div class="nama col text-sm font-bold">VALOR R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
                    <div class="nama col text-sm font-bold">TAMANHO: ${size}</div>
                    <div class="nama col text-sm font-bold">OBSERVAÇÕES: ${obs}</div>
                    <div class="nama col text-sm font-bold">ADICIONAIS: ${additionals}</div>
                    
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
            title: "CÓDIGO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "CLIENTE",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QUANTIDADE",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        },{
            data: "orderPickUpOnTheSpot",
            title: "RETIRAR?",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'DATA',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS',
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
            <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center" style="color: #14195a;font-weight: bold;">
            <div class="nama col text-sm font-bold">PRODUTO: ${d.itemsOrderuser[i].itemName} </div>
            <div class="nama col text-sm font-bold">QT: ${d.itemsOrderuser[i].itemQuantity}</div>
            <div class="nama col text-sm font-bold">VALOR R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
            <div class="nama col text-sm font-bold">TAMANHO: ${size}</div>
            <div class="nama col text-sm font-bold">OBSERVAÇÕES: ${obs}</div>
            <div class="nama col text-sm font-bold">ADICIONAIS: ${additionals}</div>
            
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
            title: "CÓDIGO",
            className: 'text-center'
        }, {
            data: "orderUserName",
            title: "CLIENTE",
            className: 'text-center'
        }, {
            data: "orderTotalItens",
            title: "QUANTIDADE",
            className: 'text-center'
        }, {
            data: "orderPaymentMethod",
            title: "PAGAMENTO",
            className: 'text-center'
        }, {
            data: "orderTotalPrice",
            title: "VALOR",
            className: 'text-center'
        }, {
            data: "orderThing",
            title: "TROCO",
            className: 'text-center'
        },{
            data: "orderPickUpOnTheSpot",
            title: "RETIRAR?",
            className: 'text-center'
        }, {
            data: 'orderStatus',
            title: 'STATUS',
            className: 'text-center'
        }, {
            data: 'orderDate',
            title: 'DATA',
            className: 'text-center'
        }, {
            data: 'orderAddressUserId',
            title: 'ENDEREÇO',
            className: 'text-center'
        },{
            data: 'orderCodId',
            title: 'STATUS',
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
            <div class="item-area shadow p-3 mb-2 bg-white rounded d-flex flex-column flex-sm-row justify-content-between align-items-center" style="color: #14195a;font-weight: bold;">
            <div class="nama col text-sm font-bold">PRODUTO: ${d.itemsOrderuser[i].itemName} </div>
            <div class="nama col text-sm font-bold">QT: ${d.itemsOrderuser[i].itemQuantity}</div>
            <div class="nama col text-sm font-bold">VALOR R$: ${Ultils.formatMoney(d.itemsOrderuser[i].itemPrice)}</div>
            <div class="nama col text-sm font-bold">TAMANHO: ${size}</div>
            <div class="nama col text-sm font-bold">OBSERVAÇÕES: ${obs}</div>
            <div class="nama col text-sm font-bold">ADICIONAIS: ${additionals}</div>
            
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
    sendMessage(data){

        var status = '';
        switch(data.status_order){
            case '2':
                    status = 'Recebemos o seu pedido!'
                break;
            case '3':
                    status = 'Seu Pedido está sendo preparado'
                break;
            case '4':
                    status = 'Seu pedido foi enviado para entrega'
                break;
            case '5':
                    status = 'Seu pedido foi entregue, obrigado pela preferencia.'
                break;
                default:
                    status = 'Aguarde Entraremos em contato';
                break
        }
        var bodyUrl = `*Olá: ${data.user[0].name}*\n\n${status}\nVocê será notificado sempre que houver um progresso no seu pedido. Obrigado pela compreensão!\n\nAtenciosamente: ${ data.company[0].name}\n\n`;
        console.log(bodyUrl)
        let isMobile = (function(a) {
            if ( /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)) ) {
                return true
            } else {
                return false
            
            }
        })(navigator.userAgent || navigator.vendor || window.opera)
    
        if ( isMobile ) {
            let target = `whatsapp://send?phone=${data.user[0].number_phone}&text=${window.encodeURIComponent(bodyUrl)}`
            window.open(target,'_blank')
        } else {
            let target = `https://api.whatsapp.com/send?phone=${data.user[0].number_phone}&text=${window.encodeURIComponent(bodyUrl)}`
            window.open(target,'_blank')
        }
          
    }
    
}