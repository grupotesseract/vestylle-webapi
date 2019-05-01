//Botao 'trocar foto'
window.uploadFile = function(btn) {
    $($(btn).parents('.controles-cropper').find('input[type=file]')).click();
}

//Da comportamento para os botões que controlam o start/confirm/cancel o cropper
window.bindCropperJS = function () {
    $('form').on('submit', function(ev) {
        swal({
            title: 'Carregando...',
            html: '<br><i class="fa fa-spin fa-spinner fa-3x"></i><br><br><br>',
            showConfirmButton: false
        });
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

