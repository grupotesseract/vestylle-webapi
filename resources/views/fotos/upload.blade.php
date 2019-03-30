{{-- Campos para upload / crop de foto --}}

@if (isset($comCropper) && $comCropper)

    <div class="controles-cropper text-center">
        <button
            type="button"
            onclick='uploadFile(this);'
            data-aspectratio="{{$aspectRatio}}"
            data-formid="{{$formID}}"
            data-previewid="{{$previewID}}"
            class="btn btn-info">
                <i class="glyphicon glyphicon-upload"></i> &nbsp; <strong>Trocar</strong>
        </button>
        <div class="hide fileupload">
            {!! Form::file(isset($name) ? $name : 'foto', isset($extraAttrs) ? $extraAttrs : null) !!}
        </div>

        <button
            type="button"
            data-aspectratio="{{$aspectRatio}}"
            data-formid="{{$formID}}"
            data-previewid="{{$previewID}}"
            class="btn btn-warning btnStartCrop">
            <i class="glyphicon glyphicon-scissors"></i> &nbsp;  Cortar
             </button>

        <button
            type="button"
            data-aspectratio="{{$aspectRatio}}"
            data-formid="{{$formID}}"
            data-previewid="{{$previewID}}"
            class="btn btn-success btnConfirmCrop" style="display:none;">
            <i class="glyphicon glyphicon-check"></i>  &nbsp; Confirmar
             </button>

        <button
            type="button"
            data-aspectratio="{{$aspectRatio}}"
            data-formid="{{$formID}}"
            data-previewid="{{$previewID}}"
            class="btn btn-danger btnCancelCrop" style="display:none;">
                <i class="glyphicon glyphicon-remove"></i>  &nbsp; Cancelar
        </button>

    </div>
@else
    {!! Form::file(isset($name) ? $name : 'foto', isset($extraAttrs) ? $extraAttrs : null) !!}
@endif



