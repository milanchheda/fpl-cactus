@extends('layouts.app')
@section('content')
	@foreach($allPlayers as $player)
		<div class="col-md-3 col-sm-6 allFlipCards">
             <div class="card-container manual-flip">
                <div class="card">
                    <div class="front">
                        <div class="cover">
                            <h3 class="name">{{ str_limit($player->first_name . ' ' . $player->last_name, 16) }}</h3>
                            <p class="profession">
                            @php
                            switch( $player->element_type ) {
							    case '1':
							        echo 'Goalkeeper';
							    	break;
							    case '2':
							        echo 'Defender';
							    	break;
							    case '3':
							        echo 'Midfielder';
							    	break;
							    case '4':
							        echo 'Forward';
							    	break;
                            }
							@endphp
                            </p>
                        </div>
                        <div class="content">
                            <div class="main">
                                <div class="stats-container">
                                    <div class="stats">
                                        <h4>{{ $player->total_points }}</h4>
                                        <p>
                                            Total Points
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>{{ $player->goals_scored }}</h4>
                                        <p>
                                            Goals Scored
                                        </p>
                                    </div>
                                    <!-- <div class="stats green">
                                        <h4>{{ $player->selected_by }}%</h4>
                                        <p>
                                            Selected By
                                        </p>
                                    </div> -->
                                    <div class="stats">
                                        <h4>{{ $player->assists }}</h4>
                                        <p>
                                            Assists
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>{{ $player->minutes }}</h4>
                                        <p>
                                            Minutes
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>{{ $player->points_per_game }}</h4>
                                        <p>
                                            Points/Game
                                        </p>
                                    </div>
                                    <div class="stats">
                                        <h4>{{ $player->clean_sheets }}</h4>
                                        <p>
                                            Clean Sheets
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="players-club {{ $player->teams->team_short_name or 'NONE'}}"></div>
                                <button class="btn btn-simple" onclick="rotateCard(this)">
                                    <i class="fa fa-mail-forward"></i> View details
                                </button>
                            </div>
                        </div>
                    </div> <!-- end front panel -->
                    <div class="back">
                        <div class="player-details">
                            <!-- <div class="green">
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Big Chances Created</label>
                                <span>12</span>
                            </div>
                            <div>
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Big Chances Missed</label>
                                <span>7</span>
                            </div> -->
                            <div class="">
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Yellow Cards</label>
                                <span>{{ $player->yellow_cards }}</span>
                            </div>
                            <div>
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Red Cards</label>
                                <span>{{ $player->red_cards }}</span>
                            </div>
                            <!-- <div class="red">
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Total Fouls</label>
                                <span>49</span>
                            </div>
                            <div>
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>No. of times offside</label>
                                <span>27</span>
                            </div> -->
                            <div>
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Penalties Missed</label>
                                <span>{{ $player->penalties_missed }}</span>
                            </div>
                            <!-- <div>
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Key Passes</label>
                                <span>78</span>
                            </div>
                            <div>
                                <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                <label>Targets Missed</label>
                                <span>37</span>
                            </div> -->
                        </div>
                        <div class="footer">
                            <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Back
                            </button>
                        </div>
                    </div> <!-- end back panel -->
                </div> <!-- end card -->
            </div> <!-- end card-container -->
        </div>
	@endforeach
    <div class="pagination"> {{ $allPlayers->links() }} </div>
@endsection
