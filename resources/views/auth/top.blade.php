@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('Top') }}</h1>
            <form method="POST" action="{{ route('top') }}">
            @csrf
                <button type="submit" value="list">{{ __('問題と答えを確認・登録する　＞') }}</button>  
                <button type="submit" value="test">{{ __('テストをする　　　　　　　　＞') }}</button>
                <button type="submit" value="history">{{ __('過去の採点結果をみる　　　　＞') }}</button>
            </form>
    </div>
</div>
@endsection
