const Dashboard = {

    construct(){
        Dashboard.init_listerns()
        // iniciando o seletor de períodos
        let start = moment().startOf('month');
        let end = moment().endOf('month');
        let dateRanges = new Array();
        dateRanges['Dia atual'] = [moment().startOf('day'), moment().endOf('day')];
        dateRanges['Dia Anterior'] = [moment().subtract(1, 'days').startOf('day'), moment().endOf('day')];
        dateRanges['Últimos Sete Dias'] = [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')];
        dateRanges['Últimos Quinze Dias'] = [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')];
        dateRanges['Últimos Trinta Dias'] = [moment().subtract(1, 'M').startOf('day'), moment().endOf('day')];
        $('#date-ranger-picker-dashboard').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            startDate: start,
            endDate: end,
            maxDate: end,
            opens: 'left',
            ranges: dateRanges
        }, function(start_, end_, label) {
            start = moment(start_).format("YYYY-MM-DD");
            end = moment(end_).format("YYYY-MM-DD");
            Dashboard.getRederIdicatorsDashboard(start, end)
            Dashboard.getDataGraphSales(start, end)
            Dashboard.allSalesByCategories(start, end)
            Dashboard.getDataShowingTop10SellingProducts(start, end)
            Dashboard.getDataTableSalesDay(start, end)
        });
        Dashboard.getRederIdicatorsDashboard(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
        Dashboard.getDataGraphSales(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
        Dashboard.allSalesByCategories(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
        Dashboard.getDataShowingTop10SellingProducts(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
        Dashboard.getDataTableSalesDay(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))

    },
    init_listerns(){
        
    },
    getRederIdicatorsDashboard(start, end){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:window.location.origin + '/admin/getIdicatorsDashboard',
            method: 'GET',
            params: {start,end}
        })
        .then((response) =>{
           
            let totalBilling = ''
            for(let i in response.data){
                
               totalBilling += response.data[i].price_total
            }
            $('.total-billing').html(response.data.revenue);
            $('.sales-amount').html(response.data.oderTotal);
            $('.orders-cofirmed').html(response.data.orderConfirmed);
            $('.orders-canceled').html(response.data.orderCanceled);
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');})
    },
    getDataGraphSales(start, end){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:window.location.origin + '/admin/getDataGraphSales',
            method: 'GET',
            params: {start,end}
        })
        .then((response) =>{
           
            const labelsAux = [];
            const actualSales =  []
            const actualCancel =  []
            const lastSales =  []
            const lastCancel =  []
            for (var i in response.data.original) {  
                labelsAux.push(response.data.original[i].day)
                actualSales .push(response.data.original[i].sales)
                lastSales .push(response.data.original[i].last_sales)
                actualCancel .push(response.data.original[i].cancel_sales)
                lastCancel .push(response.data.original[i].last_canceled_sales)
            }
            const data = {
                labels: labelsAux,
                datasets: [
                  {
                    label: 'Vendas Mes Atual',
                    data: actualSales ,
                  },
                  {
                    label: 'Cancelamentos do Mes Atual',
                    data: actualCancel ,
                  },{
                    label: 'Vendas Mes Anterior',
                    data:  lastSales,
                  },{
                    label: 'Cancelamentos do Mes Anterior',
                    data: lastCancel ,
                  }
                ]
            };
            const ctx = document.getElementById('chartSalesMonth');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                  responsive: true,
                  interaction: {
                    mode: 'index',
                    intersect: false,
                  },
                  stacked: false,
                  plugins: {
                    title: {
                      display: true,
                      text: 'Chart.js Line Chart - Multi Axis'
                    },

                        
                  },
                  scales: {
                    y: {
                      type: 'linear',
                      display: true,
                      position: 'left',
                    },
                    y1: {
                      type: 'linear',
                      display: true,
                      position: 'right',
              
                      // grid line settings
                      grid: {
                        drawOnChartArea: false, // only want the grid lines for one axis to show up
                      },
                    },
                  }
                },
              });
            
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
        .finally(()=>{$('.AppBlock').addClass('d-none');})
    },
    allSalesByCategories(start, end){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:window.location.origin + '/admin/allSalesByCategories',
            method: 'GET',
            params: {start,end}
        })
        .then((response) =>{
            const labelsAux = [];
            const total =  []
            for (var i in response.data.original) {  
                labelsAux.push(response.data.original[i].name)
                total .push(response.data.original[i].total)
            }
            const data = {
                labels: labelsAux,
                datasets: [
                  {
                    label: [],
                    data: total,
                  },
                ]
            };
            const ctx = document.getElementById('chartSalesCategories');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: data
              });
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
        .finally(()=>{$('.AppBlock').addClass('d-none');})
    },
    getDataTableSalesDay(start, end){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:window.location.origin + '/admin/getDataTableSalesDay',
            method: 'GET',
            params: {start,end}
        })
        .then((response) =>{
           Dashboard.drawTableSalesDay(response.data.original)
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');})
    },
    getDataShowingTop10SellingProducts(start, end){
        $('.AppBlock').removeClass('d-none');
        axios({
            url:window.location.origin + '/admin/getDataShowingTop10SellingProducts',
            method: 'GET',
            params: {start,end}
        })
        .then((response) =>{
           Dashboard.drawTableShowingTop10SellingProducts(response.data.original)
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
        .finally(() =>{$('.AppBlock').addClass('d-none');})
    },
    drawTableShowingTop10SellingProducts(data){
        const columns = [{
            field: "",
            title: "Produto"
        }, {
            field: "",
            title: "Categoria"
        }, {
            field: "",
            title: "Quantidade Vendida"
        },{
            field: "",
            title: "Faturamento"
        }];
        $('.table-showing-top-10-selling-products').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: false,
            searching: false,
            destroy:true,
            "displayLength": 10,
            order: [[ 3, "desc" ]],
           drawCallback: function( settings ){
               Category.inti_listerns()
           },
            columnDefs: [{
                targets: 0,
                data: function(row, type, val, meta) {
                   return row.name;
                }
            }, {
                targets: 1,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.category;
                }
            }, {
                targets: 2,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.total;
                }
            }, {
                targets: 3,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    let totalPrice = new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(row.totalBilling);
                    return 'R$ '+totalPrice
                }
            }],
        
         })
    },
    drawTableSalesDay(data){
        const columns = [{
            field: "",
            title: "Produto"
        }, {
            field: "",
            title: "Categoria"
        }, {
            field: "",
            title: "Quantidade Vendida"
        },{
            field: "",
            title: "Preço"
        }];
        $('.table-sales-day').DataTable({
            data: data,
            columns: columns,
            scrollX: false,
            paging: true,
            info: false,
            searching: false,
            destroy:true,
            "displayLength": 10,
            order: [[ 3, "desc" ]],
           drawCallback: function( settings ){
               Category.inti_listerns()
           },
            columnDefs: [{
                targets: 0,
                data: function(row, type, val, meta) {
                   return row.name;
                }
            }, {
                targets: 1,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.category;
                }
            }, {
                targets: 2,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    return row.total;
                }
            }, {
                targets: 3,
                class: 'text-center',
                data: function(row, type, val, meta) {
                    let totalPrice = new Intl.NumberFormat({ style: 'currency', currency: 'BRL' }).format(row.price);
                    return 'R$ '+totalPrice
                }
            }],
        
         })
    }
}