var nc_filesail;
$(document).ready(function() {
    var that = this;
    $.filesail= function(elem) {
        var that = this;
        this.elem               = elem;
        this.auth               = null;
        this.Views = {};
        this.Models = {};

        this.init               = function() {
            this.auth = new this.Models.Session();
            this.header = new this.Views.Header({el: $('.header-contain'), model: this.auth});
            this.landingView = new this.Views.Landing({el: $('.body-contain')});
            this.footer = new this.Views.Footer({el: $('.footer-contain')});
        };
        this.Models.Session     = Backbone.Model.extend({
            defaults: {
                api_key: null,
                username: null,
                name: null,
                email :null
            },
            initialize: function() {
                if(typeof( $.session.get('api_key'))) this.set('api_key',$.session.get('api_key'));
                if(typeof( $.session.get('username'))) this.set('username',$.session.get('username'));
                if(typeof( $.session.get('name'))) this.set('name',$.session.get('name'));
                if(typeof( $.session.get('email'))) this.set('email',$.session.get('email'));
            },
            isLoggedIn: function() {
                if(this.get('api_key') == null) return false;
                else return true;
            },

            save: function() {
                $.session.set('api_key',this.get('api_key'));
                $.session.set('username',this.get('username'));
                $.session.set('name',this.get('name'));
                $.session.set('email',this.get('email'));
            }
        });

        this.Views.Header                     = Backbone.View.extend({
            showLoginLoader : false,
            showLoginBox    : false,
            showSignupBox   : false,

            initialize      : function() {
                this.$el.hide();
                this.render();
                this.$el.fadeIn('slow');
            },
            render          : function() {
                var variables = {
                    showLoginLoader: this.showLoginLoader,
                    showLoginBox: this.showLoginBox,
                    showSignupBox: this.showSignupBox,
                    userName: this.getUserName(),
                    isLoggedIn: this.isLoggedIn()
                }
                this.$el.html( _.template($("#header-template").html(), variables));
            },
            events          : {
                "click header .buttons .login"                  : "showLogin",
                "click header .buttons .signup"                 : "showSignup",
                "click header .close"                           : "resetAuthButtons",
                "click header .login-box button.login"          : "processLogin",
                "click header .signup-box button.signup"        : "processSignup"
            },
            showLogin: function(event) {
                this.showLoginBox = true;
                this.showSignupBox = false;
                this.render();
            },
            showSignup: function(event) {
                this.showLoginBox = false;
                this.showSignupBox = true;
                this.render();
            },
            resetAuthButtons: function(event) {
                this.showLoginBox = false;
                this.showSignupBox = false;
                this.render();
            },
            isLoggedIn: function() {
                return this.model.isLoggedIn();
            },
            getUserName: function() {
                return this.model.get('name');
            },
            processLogin: function(event) {
                var login,password,container,response,parent,that;

                that = this;
                this.showLoginLoader = true;
                this.render();

                parent = $(event.currentTarget).parent();
                login = parent.find('input.login').val();
                password = parent.find('input.password').val();

                $.post(config.base_url + '/auth.php', {
                    action    : 'login',
                    login     : login,
                    password  : password
                },function(returnData) {
                    this.showLoginLoader = false;
                    //success
                    if(returnData.success === true) {
                        that.model.set({
                            api_key: returnData.key,
                            username: returnData.data.username,
                            name: returnData.data.name,
                            email :returnData.data.email
                        });
                        that.model.save();
                    }
                    //failure
                    else {
                        console.log('login error - '.returnData.message);
                    }

                    that.render();
                },'json');
            },
            processSignup: function(event) {

            }
        });

        this.Views.Footer            = Backbone.View.extend({
            initialize      : function() {
                this.$el.hide();
                this.render();
                this.$el.fadeIn('slow');
            },
            render          : function() {
                this.$el.html(_.template($("#footer-template").html(), {}));
            },
        });
        this.Views.Landing = Backbone.View.extend({
            initialize      : function() {
                this.$el.hide();
                this.render();
                this.$el.fadeIn('slow');
            },
            render          : function() {
                this.$el.html(_.template($("#landing-template").html(), {}));
            },
        });
        this.init();


    };
    nc_filesail = new $.filesail($('#container'));

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