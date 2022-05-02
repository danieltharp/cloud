<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Makoto</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #000;
                color: #600;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .makoto {
                align-items: center;
                display: flex;
                justify-content: center;
                position: relative;
                height: 100vh;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                margin-bottom: 30px;
            }

            .links > a {
                color: #600;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="makoto">
            <div class="content">
                <div class="title">
                    Makoto
                </div>

                <div class="links">
                    <a href="{{ url('/login') }}">Login</a>
                </div>
            </div>
        </div>
    </body>
</html>
