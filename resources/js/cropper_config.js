//Botao 'trocar foto'
window.uploadFile = function(btn) {
    $($(btn).parents('.controles-cropper').find('input[type=file]')).click();
}

//Se um file com .auto-upload for changed, dar submit no form de cima
window.bindUploadFile = function() {
    $('input[type=file]').on('change', function(el) {
        swal({
            title: 'Carregando...',
            html: '<br><i class="fa fa-spin fa-spinner fa-3x"></i><br><br><br>',
            showConfirmButton: false
        });
        $(el.target).parents('form').submit();
    })
}

//Da comportamento para os botões que controlam o start/confirm/cancel o cropper
window.bindCropperJS = function () {

    $('.btnStartCrop').on('click', function(ev) {
        let aspectRatio = $(ev.target).data('aspectratio');
        let previewID = $(ev.target).data('previewid');
        let formID = $(ev.target).data('formid');

        initCropper(previewID, aspectRatio, formID);
    });

    $('.btnCancelCrop').on('click', function(ev) {
        let previewID = $(ev.target).data('previewid');
        let formID = $(ev.target).data('formid');

        destroyCropper(previewID, formID);
    });

    $('.btnConfirmCrop').on('click', function(ev) {

        swal({
            title: 'Carregando...',
            html: '<br><i class="fa fa-spin fa-spinner fa-3x"></i><br><br><br>',
            showConfirmButton: false
        });

        let formID = $(ev.target).data('formid');
        let previewID = $(ev.target).data('previewid');
        let croppedImage = $(previewID).cropper('getCroppedCanvas').toDataURL('image/jpeg');

        $(formID).find('input[type=file]').remove();
        $(formID).append("<input name='foto' type='hidden'/>");
        $(formID).find('input[name=foto]').val(croppedImage);
        $(formID).submit();
    });
}

//Inicia o cropper na img com ID previewID, seguindo o aspectRatio e altera a visibilidade dos botoes do form#formID
function initCropper(previewID, aspectRatio, formID) {
    $(previewID).cropper({
        aspectRatio: aspectRatio
    });
    $(formID).find('.btnUploadFoto').hide();
    $(formID).find('.btnStartCrop').hide();
    $(formID).find('.btnConfirmCrop').show();
    $(formID).find('.btnCancelCrop').show();
}

//destroy o cropper de determinada img#previewID e reverte a visibilidade dos botoes do form#formID
function destroyCropper(previewID, formID) {
    $(previewID).cropper('destroy');
    $(formID).find('.btnUploadFoto').show();
    $(formID).find('.btnStartCrop').show();
    $(formID).find('.btnConfirmCrop').hide();
    $(formID).find('.btnCancelCrop').hide();
}

$(function () {
    bindCropperJS();
    $('input[type=file]').on('change', function(el) {
        swal({
            title: 'Carregando...',
            html: '<br><i class="fa fa-spin fa-spinner fa-3x"></i><br><br><br>',
            showConfirmButton: false
        });
        $(el.target).parents('form').submit();
    })
});
