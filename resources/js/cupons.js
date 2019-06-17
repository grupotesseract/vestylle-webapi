const controlesCupons = function () {

    $('.checkbox_aparece_listagem').change(function (ev) {

        if (this.checked) {
            $('.container-cupom-destaque').removeClass('hide');
        }
        else {
            $('.container-cupom-destaque').addClass('hide');
        }
    });

    $('.checkbox_em_destaque').change(function (ev) {

        if (this.checked) {
            $('.container-foto-destaque').removeClass('hide');
        }
        else {
            $('.container-foto-destaque').addClass('hide');
        }
    });


    $('#foto_homepage').change(function() {
        console.log("aqui");
        previewIMG(this);
    });


};

const previewIMG = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('.container-foto-destaque img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$(function () {
    controlesCupons();

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });
});
