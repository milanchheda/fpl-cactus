function getUserSelectedBets(gameweekId) {
    axios.post('/get-user-bets', {
        id: gameweekId,
    })
    .then(function (response) {
        if(response.data) {
            $(response.data).each(function(k, v){
                var gameweekDeadline = $("#gameweek-deadline").text();
                gameweekDeadline = gameweekDeadline.split(' ');
                var arrdt = gameweekDeadline[0].split("-");
                var timeS = gameweekDeadline[1].split(":");
                var userdt = new Date(arrdt[2], arrdt[1] - 1, arrdt[0],timeS[0],timeS[1]);

                var currdt = new Date();
                var yourBet = 'DRAW';
                var successFail = 'losing-selection';
                var winningTeamId = $("table.table tr#team-" + v.fixture_id).data('winning-team-id');
                    if(v.team_id != 0){
                        yourBet = v.teamName;
                        if(winningTeamId == v.team_id) {
                            successFail = 'winning-selection';
                        }
                    } else if(v.team_id == winningTeamId){
                        successFail = 'winning-selection';
                    }
                    if (userdt > currdt) {
                        successFail = 'nothing';
                    }

                    $("table.table tr#team-" + v.fixture_id).find('.user-bet').text(yourBet).addClass(successFail);
            });
        }
    });
}

$("select.stats-selector").on('change', function(){
    axios.post('/get-stats', {
        id: $(this).val(),
    })
    .then(function (response) {
        $("#fixtures-container").html(response.data);
    });
});

$("select.gameweek-list").on('change', function(event, args){
	var triggerCall = 0;
	if(args)
		triggerCall = (args.triggerCall == 1) ? args.triggerCall : 0;
	$("#gameweek-deadline").text($(this).find('option:selected').attr('date-deadline'));
	var gameweekId = $(this).val();
    var gameweekDeadline = $("#gameweek-deadline").text();
    gameweekDeadline = gameweekDeadline.split(' ');
    var arrdt = gameweekDeadline[0].split("-");
    var timeS = gameweekDeadline[1].split(":");
    var userdt = new Date(arrdt[2], arrdt[1] - 1, arrdt[0],timeS[0],timeS[1]);

    var currdt = new Date();
    if (userdt < currdt && triggerCall == 1) {
        $('.selectpicker').selectpicker('val', parseInt($(this).find('option:selected').val()) + 1);
        $("select.gameweek-list").trigger('change', {'triggerCall': 1});
        return false;
    }

	axios.post('/fixtures', {
        id: gameweekId,
        triggerCall: triggerCall
    })
    .then(function (response) {
    	$("#fixtures-container").html(response.data);
        getUserSelectedBets(gameweekId);
    });
});

$("#next-bet").on('click', function(){
	axios.post('/gameweek/next', {
        id: 'next'
    })
    .then(function (response) {
    	$('.selectpicker').selectpicker('val', response.data.next_gameweek);
    	$("select.gameweek-list").trigger('change', {'triggerCall': 1});
    });
});

$(document).on('click', 'td', function(){
    if($("#save-my-bets").is(":visible")) {
        if($(this).parents('tr:first').find('.checkmark').is(':visible') || $(this).hasClass('draw-bet') || $(this).parents('tr:first').find('td.draw-selected').length) {
        $(this).parents('tr:first').find('.checkmark').hide();
        $(this).parents('tr:first').find('td').removeClass('team-selected').removeClass('draw-selected');
        }
        if($(this).hasClass('draw-bet')) {
            $(this).parent().find('td').addClass('draw-selected');
        } else {
            $(this).addClass('team-selected').find('.checkmark').show();
        }
    }
});

$(document).on('click', '#save-my-bets', function(){
    var betsSelected = {};
    var totalGames = $('table.table tr').length;
    var userSelectionTotal = parseInt($('table.table').find('.draw-selected').length)/3 + parseInt($('table.table').find('.team-selected').length);
    if(totalGames == userSelectionTotal) {
        $('table.table tr').each(function(){
            if($(this).find('td:first').hasClass('draw-selected'))
                betsSelected[$(this).data('fixture-id')] = 0;
            else if($(this).find('.team-selected').length)
                betsSelected[$(this).data('fixture-id')] = $(this).find('.team-selected').attr('id');
        });

        axios.post('/bets/store', {
            betsSelected: JSON.stringify(betsSelected)
        })
        .then(function (response) {
            $('#messageModal').modal('show').find('.lead').html(response.data.message);
        })
        .catch(function(error){
            $('#messageModal').modal('show').find('.lead').html('Oops, something went wrong. Seems you missed the deadline.');
        });

    } else {
        alert('Please provide bets for all games.');
    }
});

$(document).ready(function(){
    if($("select.stats-selector").length) {
        $("select.stats-selector").trigger('change');
    }
});

function rotateCard(btn){
    var $card = $(btn).closest('.card-container');
    if($card.hasClass('hover')){
        $card.removeClass('hover');
    } else {
        $card.addClass('hover');
    }
}
