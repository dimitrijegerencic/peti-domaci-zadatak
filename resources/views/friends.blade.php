@extends('layouts.app')

@section('content')

    <style>

        #friends-container {
            background-color: rgb(255, 255, 255);
            margin-top: 60px;
            margin-bottom: 40px;
            width: 1000px;
            border-radius: 25px;
        }

        #title-head {
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            vertical-align: middle;
            color: rgb(0, 71, 171);
        }

        #comm {
            text-align: center;
            color: black;
            font-size: 15px;
        }

        table{
            text-align: center;
        }

        #message-button{
            background-color: white;
            color: rgb(0, 71, 171);
            font-weight: bold;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 10px;
        }

        #message-button:hover{
            background-color: rgb(0, 71, 171);
            color: white;
            font-weight: bold;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 10px;
        }

    </style>

    <div class="container shadow-lg" id="friends-container">
        <div class="row pt-lg-5 align-items-center justify-content-center">
            <div class="col-lg-10 p-lg-5 pt-lg-3 md-12" id="left">
                <div id="title-head">
                    <h4 class="display-5 fw-bold mb-3">My friends</h4>
                </div>
                <div id="comm">
                    Below you will find the list of people who are your friends
                    on ChatApp. By having someone as a friend, you have the ability to text them.
                </div>
                <div class="container ps-0">
                    <div class="container-fluid py-3">
                        <div id="form-section">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($myFriends as $friend)
                                        <tr>
                                            <td>{{$friend->name}}</td>
                                            <td>
                                                <a class="btn" id="message-button" href="{{ route('messages', ['user'=>$friend]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                        <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                                                    </svg>
                                                    Message
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
