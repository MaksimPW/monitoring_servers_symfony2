var sum = $('.serverlist').length;
console.log(sum);
/*
for(var i=1; i<=sum; i++ ) {
    var ip = $("#ip"+i).html();
    var url = "http://jsonmc.tk/old/?address=" + ip;
    $.getJSON(url, function (json) {
        var onl = console.log(json.player_online);
        var max =console.log(json.player_max);
        console.log(i);
        $("#online"+i).text(onl + "/" +max);
    });
}
*/
for(var i=1, ip, url; i<=sum; i++ ) {
    ip = $("#ip"+i).html();
    url = "http://jsonmc.tk/old/?address=" + ip;
    (function(b){
        $.getJSON(url, function (json) {
            console.log(json.player_online, json.player_max, b);
            $("#online"+b).text(json.player_online + "/" +json.player_max);
        });
    })(i);
}