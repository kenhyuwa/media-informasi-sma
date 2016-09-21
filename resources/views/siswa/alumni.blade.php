<!DOCTYPE html>
<html>
    <head>
        <title>Be right back.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            a {
                text-decoration: none;
            }
            .btn {
                font-weight: bold;
                color: #fff;
                border-radius: 1px !important;
                margin: 0px 2px;
                padding: 5px 30px;
            }
            .btn-purples {
                background-color: #DF2285;
                border: 1px solid #DF2285;

            }
            .btn-purples:hover {
                background-color: transparent;
                border: 1px solid #DF2285;
                color: #DF2285;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Anda sudah LULUS</div>
                <a href="{{ URL('dashboard/logout') }}" class="btn btn-sm btn-purples">Back</a>
            </div>
        </div>
    </body>
</html>
