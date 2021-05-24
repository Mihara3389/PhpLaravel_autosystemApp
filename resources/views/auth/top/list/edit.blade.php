@extends('layouts.app6')

@section('content')
<div class="container">
    <div class="confirm">
    <h1>{{ __('Edit') }}</h1>
            <form method="POST" action="{{ route('list.edit') }}">
            @csrf

                   
            <table  id="tbl">
                <tobody>
                @foreach ($changes as $change)    
                @if ($loop->first)
                <tr>
                    <td>問題：<input type="hidden" id="id" name="id[]" value="{{ $change->id }}"></td>
		            <td><input type="text" id="question" class="form-control @error('question.0') is-invalid @enderror" name="question[]"  value="{{ $change->question }}">
                        @error('question.0')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                </tr>
                @endif
                @endforeach
                </tobody>
                <tobody>
                @foreach ($changes as $change)    
                @isset ($change->answer)
                <tr>
                    @if ($loop->first)
                    <td> 答え：<input type="hidden" id="answer_id" name="answer_id[]" value="{{ $change->answer_id }}"></td>
                    <td><input type="text" id="answer" class="form-control @error('answer.*') is-invalid @enderror" name="answer[]"  value="{{ $change->answer }}">
                        @error('answer.*')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                    @else
                    <td>&emsp;&emsp;&emsp;<input type="hidden" id="answer_id" name="answer_id[]" value="{{ $change->answer_id }}"></td>
                    <td><input type="text" id="answer" name="answer[]"  value="{{ $change->answer }}"></td>
                    <td><input class="delbtn" type="button" id="delBtn' + count + '"  value="delete" onclick="deleteRow(this)"></td>
                    @endif
                </tr>
                @endisset
                @endforeach
                </tobody>
            </table>
            <br>
            <input id="submit" type="submit" name="return_list" value="Return">
            <input id="submit" type="submit" name="check" value="Check">
            <input type="button" name="Add" value="Add" onclick="appendRow()">
        </form>
      </div>
</div>