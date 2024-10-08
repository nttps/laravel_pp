<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BackOffice Login</title>

    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    <style>

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            height: 100%;
        }
        .container-login100 {
            width: 100%;
            min-height: 100vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            z-index: 1;
        }
        .container-login100::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .login-bg{
            background-color: #ff553a;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            width: calc(100% - 520px);
            position: relative;
            z-index: 1;
        }
        .login-content {
            width: 390px;
            border-radius: 10px;
            overflow: hidden;
            background: transparent;
            padding-top: 30px;
            padding-bottom: 50px;
        }
        .title-login{
            font-size: 28px;
            color: #fff;
            line-height: 1.2;
            text-align: center;
            text-transform: uppercase;
            display: block;
            padding-bottom: 30px;
            font-weight: 600;
        }

        .login-form {
            width: 100%;
            border-radius: 10px;
            background-color: #fff;
            padding-top: 5px;
            padding-bottom: 30px;
            box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;
        }
        .form-input {
            width: 100%;
            position: relative;
            border-bottom: 1px solid #e6e6e6;
            padding: 29px 0;
        }
        .input {
            outline: none;
            border: none;
            font-size: 20px;
            color: #555555;
            line-height: 1.2;
            display: block;
            width: 100%;
            height: 50px;
            background: transparent;
            padding: 0 10px 0 80px;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .focus-input {
            position: absolute;
            display: block;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        .focus-input::before {
            content: "";
            display: block;
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0;
            height: 1px;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            background: #d41872;
            background: -webkit-linear-gradient(left, #a445b2, #d41872, #fa4299);
            background: -o-linear-gradient(left, #a445b2, #d41872, #fa4299);
            background: -moz-linear-gradient(left, #a445b2, #d41872, #fa4299);
            background: linear-gradient(left, #a445b2, #d41872, #fa4299);
        }
        .focus-input::after {
            font-family: 'Font Awesome 5 Free';
            font-size: 18px;
            color: #999999;
            content: attr(data-placeholder);
            display: block;
            width: 100%;
            position: absolute;
            font-weight: 900;
            top: 40px;
            left: 35px;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .input:focus {
            padding-left: 60px;
        }

        .input:focus + .focus-input::after {
        left: 23px;
        color: #d41872;
        }

        .input:focus + .focus-input::before {
        width: 100%;
        }

        .has-val.input + .focus-input::after {
        left: 23px;
        color: #d41872;
        }

        .has-val.input + .focus-input::before {
        width: 100%;
        }

        .has-val.input100 {
            padding-left: 60px;
        }
        .form-btn {
            padding-top: 30px;
            width: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .btn-login{
            outline: none;
            border: none;
            font-size: 18px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;

            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            min-width: 160px;
            height: 42px;
            border-radius: 21px;

            background: #d41872;
            
            background: -webkit-linear-gradient(left, #58d5ff, #4ea1ce, #005e80);
            background: -o-linear-gradient(left,  #58d5ff, #4ea1ce, #005e80);
            background: -moz-linear-gradient(left,  #58d5ff, #4ea1ce, #005e80);
            background: linear-gradient(left,  #58d5ff, #4ea1ce, #005e80);
            position: relative;
            z-index: 1;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }
        .btn-login::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            border-radius: 21px;
            background-color: #555555;
            top: 0;
            left: 0;
            opacity: 0;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .btn-login:hover {
            background-color: transparent;
        }

        .btn-login:hover:before {
            opacity: 1;
        }
        /*------------------------------------------------------------------
        [ Alert validate ]*/

        .validate-input {
            position: relative;
        }

        .alert-validate::before {
            content: attr(data-validate);
            position: absolute;
            max-width: 70%;
            background-color: #fff;
            border: 1px solid #c80000;
            border-radius: 2px;
            padding: 4px 25px 4px 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 10px;
            pointer-events: none;
            color: #c80000;
            font-size: 13px;
            line-height: 1.4;
            text-align: left;

            visibility: hidden;
            opacity: 0;

            -webkit-transition: opacity 0.4s;
            -o-transition: opacity 0.4s;
            -moz-transition: opacity 0.4s;
            transition: opacity 0.4s;
        }

        .alert-validate::after {
            content: "\f12a";
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            font-size: 16px;
            color: #c80000;

            display: block;
            position: absolute;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 15px;
        }

        .alert-validate:hover:before {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 992px) {
            .alert-validate::before {
                visibility: visible;
                opacity: 1;
            }
        }

    </style>
</head>
<body style="background-color:#37add5;">
    <div class="container-login100">
        <div class="login-content">
            <span class="title-login">BACKEND LOGIN</span>
            <form class="login-form validate-form" method="POST" action="{{ route('admin.postlogin')}}">
                {{ csrf_field() }}
                <div class="form-input validate-input" data-validate="Enter username">
                    <input type="email" name="email" class="input " placeholder="User name">
                    <span class="focus-input" data-placeholder="&#xf007;"></span>
                </div>
                <div class="form-input validate-input" data-validate="Enter password">
                    <input type="password" name="password" class="input" placeholder="Password">
                    <span class="focus-input" data-placeholder="&#xf023;"></span>
                </div>
                <div class="form-btn m-t-32">
                    <button class="btn-login" type="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/login.js')}}"></script>

</body>
</html>