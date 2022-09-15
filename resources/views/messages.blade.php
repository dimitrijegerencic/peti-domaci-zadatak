@extends('layouts.app')

@section('content')
    <style>
        body{
            background-color: #f1f2f3;
        }
        #main-container {
            background-color: rgb(255, 255, 255);
            margin-top: 30px;
            margin-bottom: 10px;
            width: 600px;
            border: 2px solid white;
            border-radius: 25px;

        }

        #chat-header{
            width: 100%;
        }

        textarea{
            border: 2px solid darkgrey;
            border-radius: 40px;
            padding: 15px;
            resize: none;
            width: 85%;
            float: left;
        }

        #send-message-button-section{
            display: flex;
            justify-content: end;
            align-items: end;
            margin-right: 15px;
        }

        #send-message-button{
            background-color: white;
            color: rgb(0, 71, 171);
            font-weight: bold;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 30px;
            height: 40px;
        }

        #send-message-button:hover{
            background-color: rgb(0, 71, 171);
            color: white;
            font-weight: bold;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 40px;
        }

        .message-sender-box {
            position: relative;
            margin-left: 20px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f1f2f3;
            color: rgb(0, 71, 171);
            color:black;
            font-weight: lighter;
            width: 300px;
            text-align: left;
            border: 2px solid white;
            border-radius: 15px;
        }

        .message-receiver-box {
            background-color: rgb(0, 71, 171);
            color: white;
            font-weight: lighter;
            border: 1px solid white;
            border-radius: 15px;
            position: relative;
            margin-bottom: 10px;
            margin-left: calc(100% - 240px);
            padding: 10px;
            width: 200px;
            text-align: left;
            border-radius: 10px;
        }

        .message-sender-box:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;

        }

        .message-receiver-box:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
        }

        #chat-section{
            /*overflow:scroll;*/
            height: 400px;
        }


        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(0, 71, 171);
            border-radius: 50px;
        }


    </style>

<div class="container mt-3" id="main-container">
    <div id="chat-header" class="mt-3 mb-5 ms-2">
        <h6 style="float: left">Your conversation</h6>
    </div>
    <hr>
    <div class="container mt-4" id="chat-section" style="overflow-x: hidden">
        @foreach($messages as $message)
            <div class=" @if($message->user1_id==Auth::user()->id) message-receiver-box @else message-sender-box @endif">
                <p class="message-content">{{$message->message}}</p>
            </div>
        @endforeach
    </div>
    <hr>
    <div class="mt-4 mb-4">
        <form action="{{ route('messages', ['user'=>$user]) }}" method="POST">
            @csrf
            <div>
                <textarea name="message" placeholder=" Type a message..." rows="1"></textarea>
            </div>
            <div id="send-message-button-section">
                <button class="btn mt-2 mb-2" id="send-message-button" type="submit" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

    <script>

        async function reachToRequest(){

            let mainUrl = "http://127.0.0.1:8000/";
            let currentUrl = window.location.href;
            let neededId = currentUrl.substring(currentUrl.lastIndexOf('/') + 1, currentUrl.length);

            const response = await fetch(mainUrl+"getMessages/"+neededId);
            let gotMessages = await response.json();
            let currentUser = {{Auth::user()->id}};

            document.getElementById(`chat-section`).innerHTML = "";

            gotMessages.forEach( (mess) => {

                let currClass = "message-receiver-box";
                if (currentUser == mess["user1_id"])
                    currClass = "message-sender-box";

                document.getElementById(`chat-section`).innerHTML +=
                    `<div class="${currClass}">
                        <p class="message-content">${mess["message"]}</p>
                    </div>`;
            })
        }

        function checkNewMessages(){
            window.setInterval(function(){
                reachToRequest();
            }, 2000);

            reachToRequest();
        }
        checkNewMessages();

    </script>

@endsection
