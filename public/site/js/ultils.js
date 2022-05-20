var Ultils = (function() {
    'use strict';
    return {

        init_listeners: function() {

            // init evenets
            //$(".selct-tow-companies").hide()

            $('.updataIdCompany').on('click', function(e) {
                    e.preventDefault()
                    e.stopImmediatePropagation()

                    let id_user = $(this).attr('value')
                    baseURL = '/panel/getCompaniesUser/' + id_user;


                    Ultils.getCompaniesUser(baseURL, id_user);
                })
                // init functions

            window.getNameCompanyUserLogged = Ultils.getNameCompanyUserLogged();
            console.log(getNameCompanyUserLogged)

            let path_url = window.location.pathname
            if (path_url == '/panel' || path_url == '/auth/login' || path_url == '/auth/requestFreeDemo') {

                $('.AppBlock_App').hide();
            }
        },
        blockPage: function(is_block) {
            if (is_block) {
                $('.AppBlock_App').show();

            } else {
                $('.AppBlock_App').hide();
            }


        },
        getCompaniesUser: function(url, id_user) {

            axios.get(url)
                .then(function(response) {

                    var companies_id = [];
                    window.options = '';

                    $(response.data).each(function(index, value) {

                        companies_id.push(value.id);
                        options += '<option  value="' + value.id + '" >' + value.name + '</option>';
                    });
                    $(".selct-tow-companies").select2({
                        placeholder: "Selecione a empresa",
                    })
                    for (var i = 0; i < companies_id.length; i++) {

                        $(".selct-tow-companies").find('option:not(:first)').remove();
                        $(".selct-tow-companies").append(options.toUpperCase());
                    }

                    $(".selct-tow-companies").on('change', function(e) {

                        e.preventDefault()
                        e.stopImmediatePropagation()
                        let id_company = $(this).val()

                        baseURL = '/panel/updateIDCompanyUser/' + id_company;
                        Ultils.updateIDCompanyUser(baseURL)

                    })

                })
                .catch(function(response) {
                    console.log(response)
                })
        },
        updateIDCompanyUser: function(url, params) {
            axios.get(url)
                .then(function(response) {
                    swal(
                        'Sucesso!',
                        'Empresa Alterada com sucesso',
                        'success'
                    );
                    setTimeout(function() {
                        swal.close();
                        window.location.href = '/panel'
                    }, 1500);
                    $.fn.select2.defaults.reset();

                })
                .catch(function(response) {
                    console.log(response)
                })
        },
        getNameCompanyUserLogged: function() {

            let url = window.location.origin + '/panel/getNameCompanyUserLogged'
            axios.get(url)
                .then(function(response) {
                    //console.log()
                    //
                    let itemInfoCompany = `
					<img class=" rounded-circle" src="${window.location.origin}/profile/${response.data.photo}">
					<div class="content-company-name" >${response.data.name}</div>
				`
                    $('.content-info-company').html(itemInfoCompany)
                        //$('.content-company-name').html(itemInfoCompany)

                })
                .catch(function(response) {
                    console.log(response)
                })
        },
    }
})(Ultils)