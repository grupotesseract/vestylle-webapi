<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vestylle Web API</title>

        <link rel="icon" type="image/png" sizes="16x16" href="https://res.cloudinary.com/tesseract/image/upload/v1553217519/vestylle-webapi/favicon-16x16.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="m-b-md">
                    <img style="height: 90px;" src="https://res.cloudinary.com/tesseract/image/upload/v1553214101/vestylle-webapi/logo.svg" alt="Vestylle Jau">
                </div>
                <div class="title m-b-md">Admin Panel<br>
                    Vestylle Web API
                </div>

                <div class="links">
                    <a target="_blank" href="https://github.com/grupotesseract/vestylle-webapi">GitHub</a>
                    @auth
                        <a target="_blank" href="{{ url('/home') }}">Home</a>
                    @else
                        <a target="_blank" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a target="_blank" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>

