const controlesCupons = function () {

    $('.checkbox_aparece_listagem').change(function (ev) {

        if (this.checked) {
            $('.container-cupom-destaque').removeClass('hide');
        }
        else {
            $('.container-cupom-destaque').addClass('hide');
        }
    });
};



$(function () {
    controlesCupons();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });
});
