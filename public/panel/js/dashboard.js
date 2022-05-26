const Dashboard = {

    construct(){

        // iniciando o seletor de períodos
        let start = moment().startOf('month');
        let end = moment();
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
        });
        Dashboard.getRederIdicatorsDashboard(start, end)

    },
    init_listerns(){

    },
    getRederIdicatorsDashboard(start, end){
        axios({
            url:window.location.origin + '/admin/getAllOrdersCompany',
            method: 'GET',
        })
        .then((response) =>{
           
            let totalBilling = ''
            for(let i in response.data){
                
               totalBilling += response.data[i].price_total
            }
            $('.total-billing').html(response.data.revenue);
            $('.sales-amount').html(response.data.length);
        })
        .catch((error) =>{
          console.log(error.response.data)
        })
    }
}