var ip = $("#ip").html();
var url = "http://jsonmc.tk/old/?address="+ip;
$.getJSON( url, function( json ) {
    console.log( json.player_online );
    console.log( json.player_max);
    $('#online').text(json.player_online+"/"+json.player_max);
});
