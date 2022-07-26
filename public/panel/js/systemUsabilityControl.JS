var SystemUsabilityControl = {
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
        SystemUsabilityControl.getAllActions(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
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
    getAllActions(start, end){
        axios({
            method: 'GET',
            url: window.location.origin + `/admin/systemUsabilityControl/listUserUsabilityHistory`,
            params:{start,end}
       })
       .then((response) =>{
        console.log(response.data.resumied)
        KoolChart.create("chart-user-usability-history", "chartUserUsabilityHistory", "", "100%", "100%");

        var layoutStr = '<KoolChart backgroundColor="#FFFFFF" borderStyle="none">'
        +'<Options>'
        +'<Caption text="Navegação no Sistema"/>'
        +'<Legend useVisibleCheck="true"/>'
        +'</Options>'
        +'<Pie3DChart showDataTips="true"  depth="50" paddingLeft="100" paddingTop="50" paddingRight="100" paddingBottom="50">'
        +'<series>'
        +'<Pie3DSeries nameField="label" field="total" labelPosition="inside" color="#ffffff" >'
        +'<showDataEffect>'
        +'<SeriesInterpolate duration="1000"/>'
        +'</showDataEffect>'
        +'</Pie3DSeries>'
        +'</series>'
        +'</Pie3DChart>'
        +'</KoolChart>';


        KoolChart.calls("chart-user-usability-history", {
            "setLayout": layoutStr,
            "setData": response.data.resumied
        });
       }).
       catch((error) =>{
           console.log(error.response.data)
       })
       .finally(()=>{
            console.log('Hello');
       })
    }
}