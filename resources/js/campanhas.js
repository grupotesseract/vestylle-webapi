const controlesCampanha = function () {
    $('.container-item-segmentacao .checkbox-segmentacao').change(function(ev) {
        if (this.checked) {
            $(this).parents('.container-item-segmentacao').find('.item-segmentacao').removeClass('hide')
            $('.select-categorias').select2();
        }

        else {
            $(this).parents('.container-item-segmentacao').find('.item-segmentacao').addClass('hide')

        }
    });
};




$(function () {
    controlesCampanha();
});
