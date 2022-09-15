@extends('layouts.app')

@section('content')
    <style>
        #main-container {
            background-color: rgb(255, 255, 255);
            margin-top: 5px;
            width: 900px;
            height: 600px;
            border-radius: 25px;
        }

        #sign-in-head {
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
            vertical-align: middle;
            color: rgb(0, 71, 171);
        }

        #sign-in-comm {
            text-align: center;
            color: black;
        }

        #button-container {
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        #sign-in-button:hover {
            background-color: rgb(0, 71, 171);
            color: white;
            width: 200px;
            height: 50px;
            font-weight: bold;
            margin-bottom: 50px;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 25px;
        }

        #sign-in-button {
            background-color: white;
            color: rgb(0, 71, 171);
            width: 200px;
            height: 50px;
            font-weight: bold;
            margin-bottom: 50px;
            border: 2px solid rgb(0, 71, 171);
            border-radius: 25px;

        }



    </style>


    <div class="container shadow-lg" id="main-container">
        <div class="row pt-lg-2 align-items-center justify-content-center">
            <div class="col-lg-5 p-lg-5 pt-lg-3 md-8" id="left">
                <div id="sign-in-head">
                    <h1 class="display-3 fw-bold mb-3">Sign Up</h1>
                </div>
                <p class="lead" id="sign-in-comm">
                    New to ChatApp?  Join us!
                </p>
                <div class="container ps-0">
                    <div class="container-fluid py-3">
                        <div id="form-section" class="px-0">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <label for="name" class="mb-1"><strong>Name:</strong></label>
                                <input id="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="email" class="mb-1 mt-1"><strong>Email:</strong></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="mb-1 mt-1"><strong>Password:</strong></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password-confirm" class="mb-1 mt-1"><strong>Confirm password:</strong></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                <div id='button-container'>
                                    <button type="submit" class="btn mt-3 px-5" id="sign-in-button">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
