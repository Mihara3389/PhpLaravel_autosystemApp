@extends('layouts.app')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('Login') }}</h1>
            <form method="POST" action="{{ route('login') }}">
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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <input id="submit" type="submit" name="submit" value="Login">
            <br>
            <a href="{{ route('register') }}">{{ __('新規登録画面はこちら') }}</a>

            </form>
    </div>
</div>
@endsection
