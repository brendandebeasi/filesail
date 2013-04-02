var nc_filesail;
$(document).ready(function() {
    var that = this;
    $.filesail= function(elem) {
        var that = this;
        this.elem               = elem;
        this.auth               = null;
        this.headerTemplate     = null;

        this.view               = function(renderElement) {
            this.renderElement = renderElement;
            this.template   = null;
            this.model      = {};
            this.bind       = function() {

            };
            this.render     = function() {
                this.renderElement.html(this.template(this.model));
                this.bind();
            };
            this.init       = function() {

            };
            this.init();
        }

        this.header                         = new this.view(this.elem.find('.header-contain'));
        this.header.template                = Handlebars.compile($('#header-template').html());
        this.header.model                   = {
            isLoggedIn: false,
                showLoginBox: false,
                showSignupBox: false,
                showInitialButtons: true
        };

        this.header.showLoginButtonClicked  = function() {
            this.model.showLoginBox = true;
            this.model.showSignupBox = false;
            this.model.showInitialButtons = false;
            this.render();
        };

        this.header.showSignupButtonClicked = function() {
            this.model.showLoginBox = false;
            this.model.showSignupBox = true;
            this.model.showInitialButtons = false;
            this.render();
        };

        this.header.showSignupButtonClicked = function() {
            this.model.showLoginBox = false;
            this.model.showSignupBox = true;
            this.model.showInitialButtons = false;
            this.render();
        };

        this.header.closeLoginSignupClicked = function() {
            this.model.showLoginBox = false;
            this.model.showSignupBox = false;
            this.model.showInitialButtons = true;
            this.render();
        };

        this.header.bind                    = function() {
            $('header .buttons .login').click(function() {nc_filesail.header.showLoginButtonClicked()});
            $('header .buttons .signup').click(function() {nc_filesail.header.showSignupButtonClicked()});
            $('header .close').click(function() {nc_filesail.header.closeLoginSignupClicked()});
            $('header .login-box .login').click(function() {nc_filesail.header.loginButtonClicked()});
            $('header .signup-box .login').click(function() {nc_filesail.header.signupButtonClicked()});
        };

        this.landingView            = new this.view(this.elem.find('.body-contain'));
        this.landingView.template   = Handlebars.compile($('#landing-template').html());

        this.init               = function() {
            this.auth = new this.connectionStatus();

            this.header.render();
            this.landingView.render();

        };

        this.connectionStatus   = function() {
            this.isLoggedIn     = false;
            this.userName       = 'Anonymous';
            this.apiKey         = 'anonymous';
            this.authTime       = false;
        };

        this.init();
    };
    nc_filesail = new $.filesail($('#container'));
//
//    $.ajaxSetup({
//        // Disable caching of AJAX responses
//        cache: false
//    });
//    //Show login field
//    $('header .buttons .login').click(function() {
//        $(this).parent().addClass('hidden');
//        $(this).parent().parent().find('.login-box').removeClass('hidden');
//    });
//    //Show signup field
//    $('header .buttons .signup').click(function() {
//        $(this).parent().addClass('hidden');
//        $(this).parent().parent().find('.signup-box').removeClass('hidden');
//    });
//    //Close Login / Signup field
//    $('header .login-box .close-box, header .signup-box .close-box').click(function() {
//        $(this).parent().addClass('hidden');
//        $(this).parent().parent().find('.buttons').removeClass('hidden');
//    });
//    //Handle login
//    $('header .login-box .login').click(function() {
//        var login,password,container,response;
//
//        login = $('#login-login',$('header .login-box')).val();
//        password = $('#login-password',$('header .login-box')).val();
//        container = $(this).parent();
//
//        container.find('input').attr('disabled','disabled');
//
//        $.post(config.base_url + '/auth.php', {
//            action    : 'login',
//            login     : login,
//            password  : password
//        },function(returnData) {
//
//            $(this).parent().find('input').removeAttr('disabled','disabled');
//        });
//
//
//    });
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
                inject = '<li class="success"><a target="_blank" href="'+config.file_host + config.base_url +  data.result.url+'">&#x2713; ' + data.result.name +  ' (' + getBytesWithUnit(data.result.size) + ')</a></li>'
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
        },
        dropZone: $('.upload-contain')
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