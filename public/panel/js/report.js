
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
                    $('#import').html('');
                    $('#import').html('<div class="d-flex flex-column align-items-center"><i class="bi bi-check-circle-fill" style="font-size: 6rem; color: #92d72d;"></i><p style="font-size: 19px;color: #6b9c22;">Relatório Processado com Sucesso!</p></div>');

                });
                this.on("error", function(file, response) {
                    $('#import').html('');
                    $('#import').html('<div class="d-flex flex-column align-items-center"><i class="bi bi-x-octagon-fill" style="font-size: 6rem; color: red"></i><p style="font-size: 19px;color: red;">Erro ao processar o relatório. O tamanho excedeu o limite máximo de tempo de processamento</p></div>');

                });
            }
        });
    }
}