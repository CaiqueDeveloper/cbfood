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
        });
        Dashboard.getRederIdicatorsDashboard(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
        Dashboard.getDataGraphSales(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))

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
           // Use a string variable for Layout.
           KoolChart.create("chart-sales", "chartSalesMonth", "", "100%", "100%");
            var layoutCharSalesMonth =
            '<KoolChart  backgroundColor="#ffffff" borderStyle="none">'+
            '<CurrencyFormatter id="fmt" currencySymbol="R$ " alignSymbol="left" precision="2" decimalSeparatorTo= "," thousandsSeparatorTo = "."/>' 
            +'<Options>'
               +'<Caption text="Gráfico de Faturamento Mensal"/>'
               +'<SubCaption text="Mês Atual X Mês Anteriror" textAlign="center" />'
                +'<Legend useVisibleCheck="true" formatter="{fmt}"/>'
            +'</Options>'+
            '<NumberFormatter id="numFmt"  useThousandsSeparator="true" precision="2"/>' 
          +'<Line2DChart showDataTips="true" dataTipDisplayMode="axis" paddingTop="0" dataTipFormatter="{fmt}">'
              +'<horizontalAxis>'
                    +'<CategoryAxis categoryField="day" padding=""/>'
                 +'</horizontalAxis>'
               +'<verticalAxis>'
                +'<LinearAxis formatter="{fmt}" title="Indicador De Receita"/>'
                 +'</verticalAxis>'
                 +'<series>'
                     +'<Line2DSeries labelPosition="up" yField="sales" fill="#ffffff" radius="5" displayName="Realizado" showValueLabels="[5]" itemRenderer="CircleItemRenderer">'
                        +'<showDataEffect>'
                            +'<SeriesInterpolate/>'
                        +'</showDataEffect>'
                   +'</Line2DSeries>'
                     +'<Line2DSeries yField="cancel_sales" fill="#ffffff" radius="6" displayName="Cancelamentos" itemRenderer="CircleItemRenderer">'
                      +'<showDataEffect>'
                            +'<SeriesInterpolate/>'
                        +'</showDataEffect>'
                   +'</Line2DSeries>'
                     +'<Line2DSeries yField="last_sales" fill="#ffffff" radius="6" displayName="Realizo Mês Anterior" itemRenderer="CircleItemRenderer">'
                      +'<showDataEffect>'
                            +'<SeriesInterpolate/>'
                        +'</showDataEffect>'
                   +'</Line2DSeries>'
                     +'<Line2DSeries yField="last_canceled_sales" fill="#ffffff" radius="6" displayName="Cancelamento Mês anterior" itemRenderer="CircleItemRenderer">'
                      +'<showDataEffect>'
                            +'<SeriesInterpolate/>'
                        +'</showDataEffect>'
                   +'</Line2DSeries>'
                 +'</series>'
               +'<annotationElements>'
                    +'<CrossRangeZoomer zoomType="horizontal" fontSize="11" color="#FFFFFF" verticalLabelPlacement="bottom" horizontalLabelPlacement="left" enableZooming="false" enableCrossHair="true">'
                     +'</CrossRangeZoomer>'
                 +'</annotationElements>'
                +'</Line2DChart>'
             +'</KoolChart>';
            var data_sales_chart = [];
            for (var i in response.data.original) {  
                data_sales_chart.push({ "day": response.data.original[i].day, "sales": response.data.original[i].sales, "last_sales": response.data.original[i].last_sales, 'last_canceled_sales':response.data.original[i].last_canceled_sales, 'cancel_sales': response.data.original[i].cancel_sales});
            }
            
            
            KoolChart.calls("chart-sales", {
                "setLayout" : layoutCharSalesMonth,
                "setData" : data_sales_chart
            });
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
        .finally(()=>{$('.AppBlock').addClass('d-none');})
    }
}