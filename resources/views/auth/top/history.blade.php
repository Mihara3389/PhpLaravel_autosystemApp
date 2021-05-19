@extends('layouts.app3')

@section('content')
<div class="container">
    <div class="box">
        <h1>{{ __('History') }}</h1>
            <form method="POST" action="{{ route('top.history') }}">
            @csrf
    
            <table>
                <thead>
                <tr>
                    <th>{{ __('氏名') }}</th>
                    <th>{{ __('採点') }}</th>
                    <th>{{ __('採点時間') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($history_list as $history)
                <tr>
                    <td><?php $user = Auth::user(); ?>{{ $user->name }}</td>
                    <td>{{ $history->point}}</td>
                    <td>{{ $history->created_at->format("Y-m-d H:i:s") }}</td></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>