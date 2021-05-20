@extends('layouts.app5')

@section('content')
<div class="container">
    <div class="confirm">
    <h1>{{ __('Delete') }}</h1>
            <form method="POST" action="{{ route('list.delete') }}">
            @csrf

            @foreach ($deletions as $deletion)           
            <table>
                <tobody>
                @if ($loop->first)
                <tr>
                    <td>問題：<input type="hidden" id="id" name="id[]" value="{{ $deletion->id }}" readonly ></td>
		            <td><input type="text" id="question" name="question[]"  value="{{ $deletion->question }}" readonly></td>
                </tr>
                @endif
                </tobody>
                <tobody>
                @isset ($deletion->answer)
                <tr>
                    @if ($loop->first)
                    <td> 答え：</td>
                    @else
                    <td>&emsp;&emsp;&emsp;</td>
                    @endif
                    <td><input type="text" id="answer" name="answer[]"  value="{{ $deletion->answer }}" readonly></td>
                </tr>
                @endisset
                </tobody>
            </table>
            @endforeach
            <br>
            <input type="submit" name="delete" value="Delete">
            <input type="submit" name="return_list" value="Return">
        </form>
      </div>
</div>