@extends('layouts.app4')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('Register') }}</h1>
            <form method="POST" action="{{ route('list.register') }}">
            @csrf

            <div>
                <input id="question" type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question') }}" placeholder="Question" required autocomplete="question" autofocus>

                @error('question')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div>
                <input id="answer" type="text" class="form-control @error('answer') is-invalid @enderror" name="answer[]" placeholder="Answer" required autocomplete="answer">

                @error('answer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <input id="submit" type="submit" name="Return_list" value="Return">
            <input id="submit" type="submit" name="submit" value="Check">
            <input type="button" name="Add" value="Add" onclick="appendRow()">
        </form>
    </div>
</div>
@endsection
