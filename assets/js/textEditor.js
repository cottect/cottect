import 'medium-editor'

let editor = new MediumEditor('.editable', {
    toolbar: {
        allowMultiParagraphSelection: true,
        buttons: ['bold', 'italic', 'underline', 'anchor', "h1" ,'h2', 'h3', 'quote'],
        diffLeft: 0,
        diffTop: -10,
        firstButtonClass: 'medium-editor-button-first',
        lastButtonClass: 'medium-editor-button-last',
        relativeContainer: null,
        standardizeSelectionStart: false,
        static: false,
        align: 'center',
        sticky: false,
        updateOnEmptySelection: false
    },
    placeholder: {
        text: 'Tell your story...',
        hideOnClick: true
    }
});

$('#btn-upload-header-image').click(function () {

    $("#image-header-input").click();
});

$('#image-header-input').change(function() {
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#btn-upload-header-image').unbind('click').attr('style','cursor: auto;');
            $('#btn-upload-header-image .text-description').hide();
            $('#image-header').attr('src', e.target.result).attr('style', 'display:block;');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
