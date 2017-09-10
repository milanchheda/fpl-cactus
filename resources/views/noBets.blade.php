@extends('layouts.app')

@section('content')
<div class="container">
	<h4>Update with no bets</h4>
    <div class="row container">
        <select class="nobets-gameweek-list selectpicker">
        <option value="-1">Please select</option>
        @foreach($gameweeks as $gameweek)
            <option date-deadline="{{ Carbon\Carbon::parse($gameweek->deadline_time)->subHours(1)->format('d-m-Y H:i') }}" value="{{ $gameweek->id }}">Gameweek {{ $gameweek->id }}</option>
        @endforeach
        </select>

        <select class="user-list selectpicker">
        <option value="-1">Please select</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
        </select>
        <button type="button" class="btn btn-primary" id="check-with-no-bets">Check</button>
    </div>
</div>
<div class="container">
	<div class="alert margin-top-10" id='errorSuccessMessageContainer'></div>
</div>
@endsection
