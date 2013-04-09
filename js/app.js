var nc_filesail;
$(document).ready(function() {
    $.ajaxSetup({ cache: false });
    var that = this;
    $.filesail= function(elem) {
        var that = this;
        this.elem               = elem;
        this.auth               = null;
        this.Views = {};
        this.Models = {};
        this.layout = null;

        this.init               = function() {
            this.header = new this.Views.Header({el: $('.header-contain')});
            this.body = new this.Views.Landing({el: $('.body-contain')});
            this.sidebar = new this.Views.Sidebar({el: $('.sidebar-contain')});
            this.auth = new this.Models.Session();
            this.render();
        };
        this.render         = function() {
            this.header.render();
            this.body.render();
            this.sidebar.render();
        }
        this.getLoggedIn = function() {
            if(typeof(that.auth) != 'undefined' && that.auth != null) {
                if(typeof(that.auth.get('api_key')) != 'undefined' && that.auth.get('api_key') != null) return true;
                else return false;
            }
            else return false;
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
                _.bindAll(this);
                $('header .login-box').bind('keyup', this.keypress);
            },
            keypress     : function(event) {
                if(event.charCode == '13') {
                    if(event.currentTarget.className == 'login-box') this.processLogin(event);
                    if(event.currentTarget.className == 'signup-box') this.processSignup(event);
                }
            },
            render          : function() {
                var variables = {
                    showLoginLoader: this.showLoginLoader,
                    showLoginBox: this.showLoginBox,
                    showSignupBox: this.showSignupBox,
                    userName: this.getUserName(),
                    isLoggedIn: that.getLoggedIn()
                }
                this.$el.html( _.template($("#header-template").html(), variables));
            },
            events          : {
                "click header .buttons .login"                  : "showLogin",
                "click header .buttons .signup"                 : "showSignup",
                "click header .close"                           : "resetAuthButtons",
                "click header .welcome .logout"                       : "processLogout",
                "keypress header .login-box"                    : "keypress",
                "keypress header .signup-box"                   : "keypress"
            },
            showLogin: function(event) {
                this.showLoginBox = true;
                this.showSignupBox = false;
                this.render();
                this.focusLoginBox();
            },
            showSignup: function(event) {
                this.showLoginBox = false;
                this.showSignupBox = true;
                this.render();
                this.focusSignupBox();
            },
            resetAuthButtons: function(event) {
                this.showLoginBox = false;
                this.showSignupBox = false;
                this.render();
            },
            shakeLoginBox: function() {
                $(this.$el).find('.login-box').effect('shake', { times:2 }, 500);
            },
            focusLoginBox: function() {
                $(this.$el).find('.login-box input.login').focus();
            },
            focusSignupBox: function() {
                $(this.$el).find('.signup-box input.name').focus();
            },
            getUserName: function() {
                if(typeof(that.auth) != 'undefined' && that.auth != null) return that.auth.get('name');
                else return false;
            },
            processLogin: function(event) {
                var login,password,container,response,parent,shake;

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
                    that.header.showLoginLoader = false;
                    //success
                    if(returnData.success === true) {
                        that.auth.set({
                            api_key: returnData.key,
                            username: returnData.data.username,
                            name: returnData.data.name,
                            email :returnData.data.email
                        });
                        that.auth.save();
                    }
                    //failure
                    else {
                        shake = true;
                        console.log('login error - ' + returnData.message);
                    }
                    that.header.render();
                    that.sidebar.render();
                    that.body.render();
                    if(shake == true) that.header.shakeLoginBox();
                    that.header.focusLoginBox();
                },'json');
            },
            processLogout: function(event) {
                this.showLoginLoader = true;
                this.showLoginLoader= false;
                this.showLoginBox= false;
                this.showSignupBox= false;

                $.post(config.base_url + '/auth.php', {
                    action      : 'logout'
                },function(returnData) {
                    that.auth = null;
                    that.auth = new that.Models.Session();
                    $.session.clear();
                    that.body.render();
                    that.sidebar.render();
                    that.header.render();
                });
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
                var variables = {
                    isLoggedIn: that.getLoggedIn()
                };
                this.$el.html(_.template($("#footer-template").html(), variables));
            }
        });
        this.Views.Sidebar            = Backbone.View.extend({
            initialize      : function() {
                this.$el.hide();
                this.render();
                this.$el.fadeIn('slow');
            },
            render          : function() {
                var variables = {
                    isLoggedIn: that.getLoggedIn()
                }
                this.$el.html(_.template($("#sidebar-template").html(), variables));
            }
        });
        this.Views.Landing = Backbone.View.extend({
            initialize      : function() {
                this.$el.hide();
                this.render();
                this.$el.fadeIn('slow');
            },
            render          : function() {
                var variables = {
                    isLoggedIn: that.getLoggedIn()
                }
                if(variables.isLoggedIn) this.makePartialWidth();
                else this.makeFullWidth();
                this.$el.html(_.template($("#landing-template").html(), variables));
            },
            makePartialWidth : function() {
                this.$el.addClass('isLoggedIn');
            },
            makeFullWidth : function() {
                this.$el.removeClass('isLoggedIn');
            }
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