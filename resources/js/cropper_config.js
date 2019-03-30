
window.uploadFile = function(btn) {
    $($(btn).parents('.controles-cropper').find('input[type=file]')).click();
}

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

window.bindCropperJS = function () {

    $('.btnStartCrop').on('click', function(ev) {
        console.log('.btnStartCrop clicked');
        console.log(ev);
        let aspectRatio = $(ev.target).data('aspectratio');
        let previewID = $(ev.target).data('previewid');
        let formID = $(ev.target).data('formid');

        console.log(aspectRatio);
        console.log(previewID);

        initCropper(previewID, aspectRatio, formID);
    });

    $('.btnCancelCrop').on('click', function(ev) {
        console.log('.btnCancelCrop clicked');
        console.log(ev);
        let previewID = $(ev.target).data('previewid');
        let formID = $(ev.target).data('formid');

        destroyCropper(previewID, formID);
    });

    $('.btnConfirmCrop').on('click', function(ev) {
        console.log('.btnConfirmCrop clicked');
        console.log(ev);
        let formID = $(ev.target).data('formid');
        let previewID = $(ev.target).data('previewid');
        let croppedImage = $(previewID).cropper('getCroppedCanvas').toDataURL('image/jpeg');

        swal({
            title: 'Carregando...',
            html: '<br><i class="fa fa-spin fa-spinner fa-3x"></i><br><br><br>',
            showConfirmButton: false
        });

        $(formID).find('input[type=file]').remove();
        $(formID).append("<input name='foto' type='hidden'/>");
        $(formID).find('input[name=foto]').val(croppedImage);
        $(formID).submit();
    });
}

function initCropper(previewID, aspectRatio, formID) {
    console.log('formID' + formID);
    $(previewID).cropper({
        aspectRatio: aspectRatio
    });
    $(formID).find('input[type=file]').hide();
    $(formID).find('.btnStartCrop').hide();
    $(formID).find('.btnConfirmCrop').show();
    $(formID).find('.btnCancelCrop').show();
}

function destroyCropper(previewID, formID) {
    $(previewID).cropper('destroy');
    $(formID).find('input[type=file]').show();
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
