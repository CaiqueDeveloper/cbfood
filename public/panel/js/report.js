
const Report = {
    
    construct(){
        
        Report.init_listerns()
    },
    init_listerns(){
        
        Dropzone.autoDiscover = false;
        var file_second = new Dropzone("div#import", {
            url: window.location.origin + '/admin/import/processingReport',
            timeout: 300000,
            addRemoveLinks: true,
            
            init: function() {
                this.on("sending", function(file, xhr, form) {
                    form.append('_token', $('meta[name="csrf-token"]').attr('content'));
                });
                this.on("success", function(file, response) {
                    $('#second-step').html('');
                    $('#second-step').html('<div class=""><i class="fa fa-check-circle" style="font-size: 6rem; color: #92d72d;"></i><p style="font-size: 19px;color: #6b9c22;">Relatório Processado com Sucesso!</p></div>');

                    $.notify({
                        title: 'Importação realizada com sucesso',
                        message: 'Você será redirecionado para o Dashboard',
                        icon: 'fa fa-check'
                    }, {
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        animate: {
                            enter: 'animated bounce',
                            exit: 'animated bounce'
                        }
                    });

                });
            }
        });
    }
}