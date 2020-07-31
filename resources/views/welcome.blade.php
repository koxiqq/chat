<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                width: 100%;
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
                font-size: 84px;
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

            .chat {
                color: #636b6f;
                padding: 5px;
                font-size: 13px;

            }
            .bot {

                background-color: rgba(55, 203, 24, 0.83);
                padding: 5px;
                font-size: 13px;
                text-align: right;
                width: 35%;
            }
            .user {
                color: darkgray;
                background-color: #636b6f;
                padding: 5px;
                font-size: 13px;
                text-align: left;
                width: 35%;
            }
        </style>
    </head>
    <body>
        <div class="chat">
            @foreach($messages as $message)
                @if($message['sender']=='chat')
                <div class="bot">
                    {{$message['message']}}

                </div>
                @else
                <div class="user">
                    {{$message['message']}}

                </div>
                @endif
                <br>
            @endforeach
        </div>
        <form action="sendMessage" method="POST">
            @csrf
            @method('POST')
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <label>Сообщение:
                <input type="text" name="messageText">
            </label>
            <input type ="submit">
        </form>
        {{--{!! Form::open(['url'=>'sendMessage']) !!}
            {!! Form::label('Сообщение:') !!}
            {!! Form::text('messageText') !!}
            <button class="btn btn-success">Contact US!</button>
        {!! Form::close() !!}--}}
    </body>
</html>
