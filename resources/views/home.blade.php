@extends('layouts.app')

@section('content')

    <style>

        #connect-with-people-section, #main-container {
            border-radius: 25px;
        }

        #connect-quote-section, h4{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h2{
            font-family: 'Nunito', sans-serif;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            color: rgb(0, 71, 171);
        }

        #button-section{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #send-request-button{
            background-color: white !important;
            color:rgb(0, 71, 171);
            border: 2px solid rgb(0, 71, 171);
            border-radius: 20px;
            width: 200px;
            height: 50px;
            font-weight: bold;

        }

        #send-request-button:hover{
            background-color: rgb(0, 71, 171) !important;
            color:white;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 20px;
        }

        #user-card{
            width: 280px;

        }

        #decline-button{
            background-color:white !important;
            color:rgb(139, 0, 0);
            border: 2px solid rgb(139, 0, 0);
            border-radius: 20px;
            width: 100%;
        }

        #decline-button:hover{
            background-color: rgb(139, 0, 0) !important;
            color:white;
            border: 2px solid rgb(139, 0, 0);
            border-radius: 20px;
            width: 100%;
        }

        #accept-button{
            background-color: white !important;
            color:rgb(1, 50, 32);
            border: 2px solid rgb(1, 50, 32);
            border-radius: 20px;
            width: 100%;
        }

        #accept-button:hover{
            background-color: rgb(1, 100, 32) !important;
            color:white;
            border: 2px solid rgb(1, 100, 32);
            border-radius: 20px;
            width: 100%;
        }

        table{
            text-align: center;
        }

        img{
            height: 270px;
        }

    </style>

<div class="container">
    <div class="container mt-5 shadow-lg" id="connect-with-people-section">
        <div class="row pt-lg-5 align-items-center justify-content-center">
            <div class="col-lg-10 p-lg-5 pt-lg-3 col-md-12">
                <div id="quote-section">
                    <h2 class="display-3 fw-bold mb-3" id="connect-quote-section">Connect with people</h2>
                </div>
                <div class="container mt-0 col-md-12" id="users-section">
                        <div class="row">
                            @foreach($unconnectedUsers as $unconnectedUsers)
                                <div class="col-4 mt-5">
                                    <div class="card" id="user-card">
                                        <div class="card-img">
                                            <img class="card-img-top" src="{{URL::asset('/img/avatar1.jpg')}}" alt="profile Pic" height="200" width="200">
                                        </div>
                                        <div class="card-body">
                                            <div class="name-container">
                                                <h4 id="user-name-section">
                                                    {{$unconnectedUsers->name}}
                                                </h4>
                                            </div>
                                        </div>
                                        <form action="{{ route('send-request', ['user'=>$unconnectedUsers]) }}" method="POST">
                                            @csrf
                                                <div class= "mt-0 mb-2 align-items-center justify-content-center" id="button-section">
                                                    <button type="submit" class="btn mb-3" id="send-request-button">Send request</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 shadow" id="main-container">
        <div class="row pt-lg-6 align-items-center justify-content-center">
            <div class="col-lg-5 p-lg-5 pt-lg-3 md-8 mt-2" id="left">
                <div id="sign-in-head">
                    <h2 class="display-3 fw-bold mb-3">Sent requests</h2>
                </div>
                <p class="lead" id="sign-in-comm">
                    List of the people you sent friend requests to. If they accept them, you can message them.
                    Like you, they can either ignore them, accept them or delete them. <span style="color:red">Don't</span>
                    take things too personally.
                </p>
                <div class="container ps-0">
                    <div class="container-fluid py-3">
                        <table class="table table-responsive">
                            <thead>
                                <th>Account name</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                            @foreach($sentRequestUsers as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <span class="badge text-bg-warning">Pending...</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden mt-0" id="right">
                <div id="sign-in-head">
                    <h2 class="display-3 fw-bold mb-3">New requests</h2>
                </div>
                <p class="lead" id="sign-in-comm">
                    List of the requests you received. You can ignore them, accept them or decline them. It's entirely
                    up to you. Once you decline request, you can't undecline it, meaning that the person has to sent it to you again.
                </p>
                <div>
                    <table class="table table-responsive">
                        <thead>
                            <th>Account name</th>
                        </thead>
                        <tbody>
                        @foreach($arrivedRequestUsers as $arrivedRequests)
                            <tr>
                                <td>{{$arrivedRequests->name}}</td>
                                <td>
                                    <form action="{{ route('accept-request', ['user'=>$arrivedRequests]) }}" method="POST">
                                        @csrf
                                        <button type="submit" id="accept-button">Accept request</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('decline-request', ['user'=>$arrivedRequests]) }}" method="POST">
                                        @csrf
                                        <button type="submit" id="decline-button">Decline request</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
