$(document).ready(function() {
    //Show login field
    $('header .buttons .login').click(function() {
        $(this).parent().addClass('hidden');
        $(this).parent().parent().find('.login-box').removeClass('hidden');
    });
    //Show signup field
    $('header .buttons .signup').click(function() {
        $(this).parent().addClass('hidden');
        $(this).parent().parent().find('.signup-box').removeClass('hidden');
    });
    //Close Login / Signup field
    $('header .login-box .close-box, header .signup-box .close-box').click(function() {
        $(this).parent().addClass('hidden');
        $(this).parent().parent().find('.buttons').removeClass('hidden');
    });

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
                inject = '<li class="success"><a href="'+config.host + config.base_url +  data.result.url+'">&#x2713; ' + data.result.name +  ' (' + getBytesWithUnit(data.result.size) + ')</a></li>'
            }
            else {
                inject = '<li class="failed"><a href="javascript:alert(\'We are VERY sorry ^_^\');">&#x2717; ' + data.result.name + '</a></li>'
            }
            $('.upload-contain .status ul').prepend(inject);
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            var opacity;
            if(progress<=10) opacity = '0' + progress / 10;
            else opacity = progress / 10;
            $('.upload-contain .status ul li.pending').remove();
            if(progress != 100) {
                var inject = inject = '<li class="pending" style="opacity: '+opacity+'"><a href="javascript:alert(\'Hold yer horses...\');">&uarr; ' + progress + '% (' + getBytesWithUnit(data.loaded)+' / '+ getBytesWithUnit(data.total) +')</a></li>';
                $('.upload-contain .status ul').prepend(inject);

            }
            else {

            }
        }
    });
});
/**
 * @function: getBytesWithUnit()
 * @purpose: Converts bytes to the most simplified unit.
 * @param: (number) bytes, the amount of bytes
 * @returns: (string)
 */
var getBytesWithUnit = function( bytes ){
    if( isNaN( bytes ) ){ return; }
    var units = [ ' bytes', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB' ];
    var amountOf2s = Math.floor( Math.log( +bytes )/Math.log(2) );
    if( amountOf2s < 1 ){
        amountOf2s = 0;
    }
    var i = Math.floor( amountOf2s / 10 );
    bytes = +bytes / Math.pow( 2, 10*i );

    // Rounds to 3 decimals places.
    if( bytes.toString().length > bytes.toFixed(3).toString().length ){
        bytes = bytes.toFixed(3);
    }
    return bytes + units[i];
};