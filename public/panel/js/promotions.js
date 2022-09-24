const Promotions = {
    construct(){
        Promotions.init_listerns()
        Promotions.getAllPromotions()
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
        $('.remove-product-promotion').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()

            alert('Hello');
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
                    Promotions.getAllPromotions()
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
    getAllPromotions(){
        $('.AppBlock').removeClass('d-none');
        axios({
            method:'GET',
            url: window.location.origin+'/admin/getAllPromotions'
        }).then((response) =>{
           Promotions.makeTablePromotion(response.data);
        }).catch((error) =>{
            console.log(error.response.data)
        }).finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    makeTablePromotion(data){


        var columns = [{
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: '',
            title: 'EXPANDIR'
        },{
            data: "user",
            title: "CRIADO POR",
            className: 'text-center'
        }, {
            data: "typePromotion",
            title: "TIPO DA PROMOÇÃO",
            className: 'text-center'
        }, {
            data: "typeDecount",
            title: "TIPO DO DESCONTO",
            className: 'text-center'
        }, {
            data: "descount",
            title: "DESCONTO",
            className: 'text-center'
        }, {
            data: "periodStart",
            title: "PERÍODO INICIAL",
            className: 'text-center'
        }, {
            data: "periodEnd",
            title: "PERÍODO FINAL",
            className: 'text-center'
        },{
            data: "status",
            title: "STATUS",
            className: 'text-center'
        },{
            data: "id",
            title: "AÇÕES",
            className: 'text-center'
        }];
        var table = $('.table-promotions').DataTable({
            destroy: true,
            columns: columns,
            data: data,
            order: [
            [1, "desc"]
            ],
            drawCallback: function( settings ){},
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
                    return a;
                }
            }, {
                targets: 2,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 3,
                orderable: true,
                render: function(a, n, e, s) {
                   return a;
                }
            },{
                targets: 4,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;
                }
            }, {
                targets: 5,
                orderable: true,
                render: function(a, n, e, s) {
                   return moment(a).format('DD/MM/YYYY')
                }
            }, {
                targets: 6,
                orderable: true,
                render: function(a, n, e, s) {
                    return moment(a).format('DD/MM/YYYY')
                }
            }, {
                targets: 7,
                orderable: true,
                render: function(a, n, e, s) {
                    return a;
                }
            },{
                targets: 8,
                orderable: true,
                render: function(a, n, e, s) {
                    return `
                    <a href="#" class="show-modal-update-product text-info" value="${a}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                        </svg>  
                    </a>
                    <a href="#" class="delete-product text-danger" value="${a}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                        </svg>
                    </a>
                    `;
                }
            }]
        });
        $('.table-promotions tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
     
            if (row.child.isShown()) {
                row.child.hide();
                tr.removeClass('shown');
                
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }

        });
        //Creating sub children table
        function format(d) {
            setTimeout(()=>{
                Ultils.runAtcinoApplyDatableInTable(Promotions)
            },10)
            let row = ''
            for(let i in d.collaps){
                row += `
                    <tr>
                        <td>${d.collaps[i].product_name}</td>
                        <td class="text-center">${d.collaps[i].status}</td>
                        <td class="text-center">
                            <a href="#" class="remove-product-promotion text-danger" value="${d.collaps[i].product_id}" data-promotion_id="${d.collaps[i].promotion_id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                </svg>
                            </a>
                        </td>
                     </tr>
                `
            }
            let table = `
            <table class="table table-info table-bordered" id="subtable">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                ${row}
                </tbody>    
            </table>
            `
           
                
          return table;
        } 
    }
}