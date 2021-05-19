@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('Top') }}</h1>
            <form method="POST" action="{{ route('top') }}">
            @csrf
                <input type="submit" name='list' value='問題と答えを確認・登録する　＞'>
                <input type="submit" name='test' value='テストをする　　　　　　　　＞'>
                <input type="submit" name='history' value='過去の採点結果をみる　　　　＞'>
            </form>
    </div>
</div>
@endsection
