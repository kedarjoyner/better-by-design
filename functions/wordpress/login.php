<?php

function my_login_logo() { ?>
<style type="text/css">
  #login h1 a, .login h1 a {
    background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login/dirigible.svg);
    padding-bottom: 10px;
    opacity: .8;
  }
  #login {
    position: relative;
    z-index: 2;
  }
  body.login {
    background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login/login.jpg);
    display: block;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    z-index: 1;
  }
  body.login:after {
		content: "";
    display: block;
		position: absolute;
		top: 0px; left: 0px; right: 0px; bottom: 0px;
		background: rgba(0,0,0, .3);
	}
  #loginform {
    text-align: center !important;
    background: rgba(255,255,255,.8);
    background-color: rgba(255,255,255,.8) !important;
  }
  .login #login_error, .login .message {
    text-align: center !important;
    background: rgba(255,255,255,0);
    background-color: rgba(255,255,255,0) !important;
    border: 0px !important;
    color: #fff !important;
    text-align: center;
    opacity: .8;
    margin-bottom: 10px !important;
  }
  .login #login_error a , .login .message a {
    color: #fff !important;
  }
  input {
    text-align: center;
  }
  .login form {
    margin-top: 0px !important;
    margin-left: 0;
    padding: 30px !important;
  }
  .login #nav a , .login #backtoblog a {
    display: block;
    color: #fff !important;
    text-align: center;
    opacity: .6;
  }
  .login #nav a:hover , .login #backtoblog a:hover {
    opacity: 1;
  }
  .login form .input, .login input[type=text] {
    background: none !important;
    outline: none !important;
    box-shadow: none !important;
    border-top: 0px !important;
    border-left: 0px !important;
    border-right: 0px !important;
    border-bottom: 1px solid #bbb !important;
  }
  .login input[type=text]:focus {
    background: rgba(0,0,0,.1) !important;
  }
  .forgetmenot {
    display: block;
    text-align: center;
    width: 100%;
  }
  p.submit {
    display: block;
    text-align: center !important;
  }
  .login .button-primary {
    margin-top: 20px !important;
    float: none !important;
    border-radius: 0px !important;
    border: 0px !important;
    box-shadow: none !important;
    font-weight: bold !important;
    background: rgb(54, 56, 51) !important;
    text-shadow: none !important;
    padding: 6px 24px !important;
    height: auto !important;
  }
  .login .button-primary:hover {
    background: rgb(43, 49, 51) !important;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
