@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('Register') }}</h1>
            <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <input id="submit" type="submit" name="submit" value="Register">
            <br>
            <a href="{{ route('login') }}">{{ __('ログイン画面はこちら') }}</a>

        </form>
    </div>
</div>
@endsection
