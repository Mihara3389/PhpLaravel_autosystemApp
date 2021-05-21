@extends('layouts.app6')

@section('content')
<div class="container">
    <div class="confirm">
    <h1>{{ __('Edit_Confirm') }}</h1>
            <form method="POST" action="{{ route('confirm.edit') }}">
            @csrf

            <table>
                <tobody>
                <tr>
                    <td>問題：<input type="hidden" id="id" name="id" value="{{ $id }}" readonly ></td>
		            <td><input type="text" id="question" name="question"  value="{{ $question }}" readonly></td>
                </tr>
                </tobody>
                <tobody>
                @if(@!empty($aid_list) and @!empty($answer_list))
                <tr>
                @for($i = 0; $i < count($aid_list); ++$i)          
                    @if($i === 0)
                    <td> 答え：</td>
                    @endif
                    <input type="hidden" id="answer_id" name="answer_id[]" value="{{ $aid_list[$i] }}">
                @endfor    
                    <td>
                    @for($j = 0; $j < count($answer_list); ++$j)  
                        <input type="text" id="answer" name="answer[]"  value="{{ $answer_list[$j] }}" readonly>
                    @endfor
                    </td>
                </tr>
                @endif
                </tobody>
            </table>
            <br>
            <input type="submit" name="update" value="Update">
            <input type="submit" name="return_edit" value="Return">
        </form>
      </div>
</div>