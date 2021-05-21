@extends('layouts.app6')

@section('content')
<div class="container">
    <div class="confirm">
    <h1>{{ __('Register_Confirm') }}</h1>
            <form method="POST" action="{{ route('confirm.register') }}">
            @csrf

            <table>
                <tobody>
                <tr>
                    <td>問題：</td>
		            <td><input type="text" id="question" name="question"  value="{{ $question }}" readonly></td>
                </tr>
                </tobody>
                <tobody>
                @foreach ($registers as $register)           
                @isset ($register)
                <tr>
                    @if ($loop->first)
                    <td> 答え：</td>
                    @else
                    <td>&emsp;&emsp;&emsp;</td>
                    @endif
                    <td><input type="text" id="answer" name="answer[]"  value="{{ $register }}" readonly></td>
                </tr>
                @endisset
                @endforeach
                </tobody>
            </table>
            <br>
            <input type="submit" name="register" value="Register">
            <input type="submit" name="return_register" value="Return">
        </form>
      </div>
</div>