<!DOCTYPE html>
<html>
    <head>
        <title>Tasks list</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap-theme-cosmo.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #1B6B24;
                display: table;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
                font-weight: 100;
                font-family: 'Lato';
            }

            .title {
                font-size: 96px;
                margin-bottom: 40px;
            }

            .welcome-note {
                font-size: 60px;
            }
            .auth-div {
                margin: 40px 0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Tasks list</div>
                <div class="welcome-note">Do not forget anything important!</div>
            </div>
            <div class="auth-div">
                <a href="{!! action('Auth\AuthController@getLogin') !!}" class="btn btn-primary">Login</a>
                <a href="{!! action('Auth\AuthController@getRegister') !!}" class="btn btn-success">Register</a>
            </div>
        </div>
    </body>
</html>
