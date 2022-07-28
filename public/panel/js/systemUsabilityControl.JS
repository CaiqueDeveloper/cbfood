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

        SystemUsabilityControl.getSummaryIdicator(moment().startOf('day').format("YYYY-MM-DD"), moment().startOf('day').format("YYYY-MM-DD"), modules, company)
        SystemUsabilityControl.getAllActions(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
        SystemUsabilityControl.getData(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"), modules, company);

        $('.search-system-usability-period').on('click', function(e){
            e.preventDefault()
            e.stopImmediatePropagation()
            SystemUsabilityControl.getAllActions(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"))
            SystemUsabilityControl.getData(moment(start).format("YYYY-MM-DD"), moment(end).format("YYYY-MM-DD"), modules, $('#selectCompany option').filter(':selected').val());
            
        })
        
    },
    getSummaryIdicator(start, end,modules,company){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + `/admin/systemUsabilityControl/summaryIdicator`,
            params:{start,end,modules,company}
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
            $('.AppBlock').addClass('d-none');
       })
    },
    getAllActions(start, end){
        $('.AppBlock').removeClass('d-none');
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
            $('.AppBlock').addClass('d-none');
       })
    },
    getData(start, end,modules,company){
        $('.AppBlock').removeClass('d-none');
        axios({
            method: 'GET',
            url: window.location.origin + `/admin/systemUsabilityControl/getData?`,
            params:{start,end,modules,company}
        })
        .then((response) =>{
           SystemUsabilityControl.drawTable(response.data)
        }).
        catch((error) =>{
           console.log(error.response.data)
        })
       .finally(()=>{
            $('.AppBlock').addClass('d-none');
        })
    },
    drawTable(data){
        let response = [];
        let columns = [{
            field: "",
            title: "Nome"
        },{
            field: "",
            title: "Perfil"
        },{
            field: "",
            title: "Ativo Em"
        }, {
            field: "",
            title: "Total de Empresas"
        }, {
            field: "",
            title: "Ultimo Acesso"
        },{
            field: "",
            title: "Ações"
        }]
        for(let i in data){
            response.push(data[i])
        }
       console.log(response)
        //MakeTable
        let table = $('.makeTableSystemUsabilityControl').DataTable({
            data: response,
            columns: columns,
            scrollX: false,
            paging: true,
            info: false,
            searching: true,
            destroy: true,
            "displayLength": 10,
            order: [
            [3, "desc"]
            ],
            drawCallback: function( settings ){
                $('.view-actions').on('click', function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    var id = $(this).attr('data-id')
                    User.getUserActions(id, start, end);
                })
            },
            columnDefs: [{
                defaultContent: '-',
                targets: 0,
                className: 'text-left',
                data: function(row, type, val, meta) {
                    return row.name
                }
            }, {
                targets: 1,
                className: 'text-center',
                data: function(row, type, val, meta) {
                    return row.profile
                }
            },{
                targets: 2,
                className: 'text-center',
                data: function(row, type, val, meta) {
                    return row.company
                }
            }, {
                targets: 3,
                className: 'text-center',
                data: function(row, type, val, meta) {
                   
                    return row.total_company
                }
            }, {
                targets: 4,
                type: 'date',
                className: 'text-center',
                data: function(row, type, val, meta) {
                   return row.last_access;
                    
                }

            },{
                targets: 5,
                className: 'text-center',
                data: function(row, type, val, meta) {
                    return '<div><a  class="btn btn-outline-accent m-btn m-btn--icon text-success m-btn--icon-only m-btn--pill view-actions" data-id="' + row.id + '" href="javascript:void(0);"><i class="bi bi-bar-chart-line-fill"></i></a></div>';
                }
            }],
        })
        $('.input-filter-user').on('keyup', function(e){
            e.preventDefault()
            table.search($(this).val()).draw();
        })
    },
}