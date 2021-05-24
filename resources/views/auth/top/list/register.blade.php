@extends('layouts.app6')

@section('content')
<div class="container">
    <div class="confirm">
        <h1>{{ __('Register') }}</h1>
            <form method="POST" action="{{ route('list.register') }}">
            @csrf

            <table  id="tbl">
                <tobody>
                <tr>
                    <td>問題：</td>
		            <td><input type="text" id="question"　class="form-control @error('question') is-invalid @enderror" name="question" placeholder="Question">
                        @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                </tr>
                </tobody>
                <tobody>
                <tr>
                    <td> 答え：</td>
                    <td><input type="text" id="answer" class="form-control @error('answer.*') is-invalid @enderror"　name="answer[]" placeholder="Answer">
                        @error('answer.*')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </td>
                </tr>
                </tobody>
            </table>
            <br>
            <input id="submit" type="submit" name="return_list" value="Return">
            <input id="submit" type="submit" name="check" value="Check">
            <input type="button" name="Add" value="Add" onclick="appendRow()">
        </form>
    </div>
</div>
@endsection
