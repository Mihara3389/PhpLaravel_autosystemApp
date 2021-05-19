@extends('layouts.app4')

@section('content')
<div class="container">
    <div class="box">
    <h1>{{ __('Result') }}</h1>
        @csrf
      
        <table>
            <tr>
                <td><?php $user = Auth::user(); ?>{{ $user->name }}{{ __('さん') }}</td>
            </tr>
            <tr>
                <td>{{ $all_count}}{{ __('問中') }}{{ $correct_count}}{{ __('問正解です。') }}</td>
            </tr>
            <tr>   
                <td>{{ $point}}{{ __('点でした。') }}</td>
		    </tr>
        </table>
        <div class="form">{{$now}}</div>    
    </div>
</div>