@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('History') }}</h1>
            <form method="POST" action="{{ route('history') }}">
            @csrf
    
            <table>
                <thead>
                    <tr>
                        <th>{{ __('氏名') }}</th>
                        <th>{{ __('採点') }}</th>
                        <th>{{ __('採点時間') }}</th>
                    </tr>
                </thead>
            </table>
        </form>
    </div>
</div>