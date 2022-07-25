const SystemUsabilityControl = {
    construct(){
        SystemUsabilityControl.init_listerns()
    },
    init_listerns(){
        /* --- Primeira chamada ---*/

        let company = $('#selectCompany').val();
        let modules = $('#selectModules').val();
        let start = moment().startOf('month');
        let end = moment();
        let dateRanges = new Array();
        dateRanges['Dia atual'] = [moment().startOf('day'), moment().endOf('day')];
        dateRanges['Dia Anterior'] = [moment().subtract(1, 'days').startOf('day'), moment().endOf('day')];
        dateRanges['Últimos Sete Dias'] = [moment().subtract(7, 'days').startOf('day'), moment().endOf('day')];
        dateRanges['Últimos Quinze Dias'] = [moment().subtract(15, 'days').startOf('day'), moment().endOf('day')];
        dateRanges['Últimos Trinta Dias'] = [moment().subtract(1, 'M').startOf('day'), moment().endOf('day')];
        $('#systemUsabilityControlDatePicker').daterangepicker({
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
        });

        SystemUsabilityControl.getSummaryIdicator()
        
    },
    getSummaryIdicator(){
        
        axios({
            method: 'GET',
            url: window.location.origin + `/admin/systemUsabilityControl/summaryIdicator`,
       })
       .then((response) =>{
            $('.totalUserActive').html(response.data.usersActive.total)
            $('.goalUserActive').html(response.data.usersActive.goal)
            $('.totalCompaniesActive').html(response.data.companiesActive.total)
            $('.goalCompaniesActive').html(response.data.companiesActive.goal)
            $('.totalCompaniesInactive').html(response.data.companiesInative.total)
            $('.goalCompaniesInactive').html(response.data.companiesInative.goal)
       }).
       catch((error) =>{
           console.log(error.response.data)
       })
       .finally(()=>{
            console.log('Hello');
       })
    },
}