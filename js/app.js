$(document).ready(function() {

    //Map the upload button image to trigger the real upload image
    $('#upload-button').click(function() {
        $('#upload-field').trigger('click');
    });

    //Setup fileuploader
    $('#upload-field').fileupload({
        dataType: 'json',
        done: function (e, data) {
            var inject;
            if(data.result.success == true) {
                inject = '<li class="success"><a href="'+config.host + data.result.url+'">&#x2713; ' + data.result.name + '</a></li>'
            }
            else {
                inject = '<li class="failed"><a href="javascript:alert(\'We are VERY sorry ^_^\');">&#x2717; ' + data.result.name + '</a></li>'
            }
            $('.upload-completed ul').prepend(inject);
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