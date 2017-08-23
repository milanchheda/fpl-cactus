@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row container">
        <select class="{{ Request::is('stats') ? 'stats-selector selectpicker' : 'gameweek-list selectpicker' }}">
        @if(Request::is('stats'))
            <option value="-1">Overall stats</option>
        @else
            <option value="-1">Please select</option>
        @endif

        @foreach($gameweeks as $gameweek)
            <option date-deadline="{{ Carbon\Carbon::parse($gameweek->deadline_time)->subHours(1)->format('d-m-Y H:i') }}" value="{{ $gameweek->id }}">Gameweek {{ $gameweek->id }}</option>
        @endforeach
        </select>
        <!-- <button type="button" class="btn btn-primary" id="next-bet">Bets for next Gameweek</button> -->
    </div>
    <div class="row container">
        @if(Request::is('home'))
            <div class="text-right text-danger">
                <label>Deadline: </label>
                <span id="gameweek-deadline"></span>
            </div>
        @endif
        <div id="fixtures-container"></div>
    </div>
</div>
@endsection
