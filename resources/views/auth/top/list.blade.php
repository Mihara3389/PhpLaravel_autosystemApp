@extends('layouts.app5')

@section('content')
<div class="container">
    <div class="box">
           <form method="POST" action="{{ route('top.list') }}">
            @csrf

            <h1>{{ __('List') }}</h1>
            <div><input type="submit" name="register" value="Register"></div>
            <br>
            @foreach ($lists as $list)           
            <table>
                <tbody>
                @if($list->no ===1)
                <tr>
                    <td>問題</td>
                    <td><input type="text" id="id" name="id[]" value="{{ $list->id }}" readonly ></td>
		            <td><input type="text" id="question" name="question[]"  value="{{ $list->question }}" readonly></td>
                    <td>
                        <div><input type="submit" name="edit" value="Edit">
		                <input type="hidden" name="id" value="{{ $list->id }}"></div>
                    </td>
                    <td>
                        <div><input type="submit" name="delete" value="Delete">
		                <input type="hidden" name="id" value="{{ $list->id }}"></div>
                    </td>
                </tr>
                @endif
                </tobody>
                <tobody>
                @isset ($list->answer)
                <tr>
                    <td> 答え</td>
                    <td><input type="text" id="no" name="no[]"  value="{{ $list->no }}" readonly></td>
                    <td><input type="text" id="answer" name="answer[]"  value="{{ $list->answer }}" readonly></td>
                    <td></td>
                    <td></td>
                </tr>
                @endisset
                </tbody>
            </table>
            @endforeach
        </form>
      </div>
</div>