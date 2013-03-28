$(document).ready(function() {

    //Map the upload button image to trigger the real upload image
    $('#upload-button').click(function() {
        $('#upload-field').trigger('click');
    });

    //Setup fileuploader
    $('#upload-field').fileupload({
        dataType: 'json',
        done: function (e, data) {
            //debugger;
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        }
    });
});