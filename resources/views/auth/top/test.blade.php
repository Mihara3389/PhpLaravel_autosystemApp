@extends('layouts.app4')

@section('content')
<div class="container">
    <div class="box">
    <h1>{{ __('Test') }}</h1>
            <form method="POST" action="{{ route('top.test') }}">
            @csrf

            @foreach ($questions as $question)           
            <table>
                <tr>
                    <td><input type="text" id="id" name="id[]" value="{{ $question->id }}" readonly ></td>
		            <td><input type="text" id="question" name="question[]"  value="{{ $question->question }}" readonly></td></tr>
                </tr>
                <tr>
                    <td> 回答：</td>
                    <td><input type="text" id="answer" name="answer[]" placeholder="Answer"></td></tr>
                </tr>
            </table>
            @endforeach
        </form>
        <input id="submit" type="submit" name="submit" value="Check">
    </div>
</div>