<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.cardSpec {
  border: none;
}
.specTit {
  font-weight: 800
}
.specNum {
  font-weight: 300
}
</style>
<?php
$output = shell_exec('php -f loadPlayers.php');
$output = shell_exec('php -f loadTeams.php');
$output = shell_exec('php -f loadTeamURL.php');
$output = shell_exec('php -f loadURL.php');

// echo "<pre>$output</pre>";

include("/etc/php/pdo-nba.php");
$dbh = dbconnect();

?>
</head>

<body>






<script>
var playerids = <?php echo json_encode($playerids) ?>;


$(document).ready(function(){
    var statsSelection = null;
    $("#homeTeams").hide();
    $("#playNav").hide();
    $("#teamNav").hide();
    $("#homeTeams").hide();
    $("#homePlayers").show();
    $("#playNavInact").hide();
    $("#playNav").show();
    $("#teamNavInact").show();
    $("#teamNav").hide();




    $("#playNavInact").click(function() {
      $("#homeTeams").hide();
      $("#homePlayers").show();
      $("#playNavInact").hide();
      $("#playNav").show();
      $("#teamNavInact").show();
      $("#teamNav").hide();
    });
    $("#teamNavInact").click(function() {
      $("#homeTeams").show();
      $("#homePlayers").hide();
      $("#teamNavInact").hide();
      $("#teamNav").show();
      $("#playNavInact").show();
      $("#playNav").hide();

    });


//PLAYER Comparator Search
  $("#statCompPlayerSearch").click(function() {
      var request;
      var $form = $("#playerStatComp");

      var $inputs = $form.find("input, select, button, textarea");
      var serializedData = $form.serialize();
      //console.log(serializedData);
      request = $.ajax({
              url: "statComp.php",
              type: "get",
              data: serializedData,
              dataType: 'json'
          });

          // Callback handler that will be called on success
   request.done(function (response, textStatus, jqXHR){
       // Log a message to the console
       var data = response;
       p = JSON.parse(data[0]);

       //console.log(p)
       // console.log(p[0].imageurl.toString());
       // console.log(p[1].imageURL.toString());
       var num = p.length;
       var newCard = $('<div class="card-deck container" id="returnedCards"/>');
       for(var i = 0; i < num; i++) {
         newCard.append('<div class="col-sm-4 mb-3"><div class="card text-center" id="'.concat(p[i].playerid).concat('"> <img class="card-img-top" src="').concat(p[i].imageurl.toString())
         .concat('"><div class="card-body"><h5 class="card-title">').concat(p[i].firstname).concat(' ').concat(p[i].lastname).concat('</h5><p class="card-text"> PTS/GM: ').
         concat(p[i].ptspergame.toString()).concat('<p class="card-text"> REB/GM: ').
         concat(p[i].rebpergame.toString()).concat('</p>').concat('<p class="card-text"> AST/GM: ').
         concat(p[i].astpergame.toString()).concat('</p><button type="button" class="btn btn-outline-primary seeMorePlayer" id="').concat(p[i].playerid.toString()).
         concat('"name="seeMorePlayer">See More</button></div></div></div>'));

       }
       $('#temp').html(newCard);

       $(".seeMorePlayer").on('click',function() {
         var pID = "playerID=".concat(this.id);
         console.log(pID);
         request = $.ajax({
                 url: "seeMorePlayer.php",
                 type: "get",
                 data: pID,
                 dataType: 'json'
             });

             request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                var data = response;
                p = JSON.parse(data[0])[0];
                console.log(p.playerid);
                $("#returnedCards").hide();

                var newCard = $('<div class="card-columns"/>');
              newCard.append('<div class="card bg-light"><img class="card-img-top" src="'.
              concat(p.imageurl).concat('" alt="Card image cap"><div class="card-body text-center"><h4 class="card-title">').
              concat(p.firstname).concat(' ').concat(p.lastname).concat('</h4><div><p class="card-text font-weight-bold">Current Team </p>').
              concat(p.currentteamabbrev).concat('</div><div><p class="card-text font-weight-bold">Primary Position </p> ').concat(p.primaryposition).
              concat('</div><p class="card-text font-weight-bold">Injury Status </p> ').concat(p.injurystatus).concat('</div></div>').
              concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Games Played</h5><h3 class="specNum">').
              concat(p.gamesplayed).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Pts Per Game</h5><h3 class="specNum">').
              concat(p.ptspergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FG Pct</h5><h3 class="specNum">').
              concat(p.fgpct).concat('</h3></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">2-Point FG Pct</h5><h3 class="specNum">').
              concat(p.fg2ptpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">2-Point FG Attempts Per Game</h5><h3 class="specNum">').
              concat(p.fg2ptattpergame).concat('</h5></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">3-Point FG Pct</h5><h3 class="specNum">').
              concat(p.fg3ptpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">3-Point FG Attempts Per Game</h5><h3 class="specNum">').
              concat(p.fg3ptattpergame).concat('</h5></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FG Attempts Per Game</h5><h3 class="specNum">').
              concat(p.fgattpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">True Shooting Pct</h5><h3 class="specNum">').
              concat(p.trueshootingpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FT Pct</h5><h3 class="specNum">').
              concat(p.ftpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FT Attempts Per Game</h5><h3 class="specNum">').
              concat(p.ftattpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Reb Per Game</h5><h3 class="specNum">').
              concat(p.rebpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Off Reb Per Game</h5><h3 class="specNum">').
              concat(p.offrebpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Def Reb Per Game</h5><h3 class="specNum">').
              concat(p.defrebpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Ast Per Game</h5><h3 class="specNum">').
              concat(p.astpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Steals Per Game</h5><h3 class="specNum">').
              concat(p.stlpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Blocks Per Game</h5><h3 class="specNum">').
              concat(p.blkpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Tov Per Game</h5><h3 class="specNum">').
              concat(p.tovpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Plus Minus Per Game</h5><h3 class="specNum">').
              concat(p.plusminuspergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Min Played Per Game</h5><h3 class="specNum">').
              concat(p.minutesplayedpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Player Efficiency Rating</h5><h3 class="specNum">').
              concat(p.per).concat('</h3></div></div></div>'));

              $('#temp').html(newCard );

         });

    });


   });

   // Callback handler that will be called on failure
   request.fail(function (jqXHR, textStatus, errorThrown){
       // Log the error to the console
       console.error(
           "The following error occurred: "+
           textStatus, errorThrown
       );
   });

   // Callback handler that will be called regardless
   // if the request failed or succeeded
   request.always(function () {
       // Reenable the inputs
       $inputs.prop("disabled", false);
   });



      });
//TEAM Comparator Search
  $("#statCompTeamSearch").click(function() {
      var request;
      var $form = $("#teamStatComp");

      var $inputs = $form.find("input, select, button, textarea");
      var serializedData = $form.serialize();
      //console.log(serializedData);
      request = $.ajax({
              url: "statTeamComp.php",
              type: "get",
              data: serializedData,
              dataType: 'json'
          });

          // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
       // Log a message to the console
       var data = response;
       p = JSON.parse(data[0]);

       //console.log(p)
       // console.log(p[0].imageurl.toString());
       // console.log(p[1].imageURL.toString());
       var num = p.length;
       var newCard = $('<div class="card-deck container" id="returnedCards"/>');
       for(var i = 0; i < num; i++) {
         newCard.append('<div class="col-sm-4 mb-3"><div class="card text-center" id="'.concat(p[i].teamid).concat('"> <img class="card-img-top" src="').concat(p[i].imageurl.toString())
         .concat('"><div class="card-body"><h5 class="card-title">').concat(p[i].teamcity).concat(' ').concat(p[i].teamname).concat('</h5><p class="card-text"> Wins: ').
         concat(p[i].wins.toString()).concat('<p class="card-text"> Losses: ').
         concat(p[i].losses.toString()).concat('</p>').concat('<p class="card-text"> Plus-Minus/Game: ').
         concat(p[i].plusminuspergame.toString()).concat('</p><button type="button" class="btn btn-outline-primary seeMoreTeam" id="').concat(p[i].teamid.toString()).
         concat('"name="seeMoreTeam">See More</button></div></div></div>'));

       }
       $('#temp').html(newCard);

       $(".seeMoreTeam").on('click',function() {
         var tID = "teamID=".concat(this.id);
         //console.log(tID);
         request = $.ajax({
                 url: "seeMoreTeam.php",
                 type: "get",
                 data: tID,
                 dataType: 'json'
             });

             request.done(function (response, textStatus, jqXHR){
                // Log a message to the console
                var data = response;
                p = JSON.parse(data[0])[0];
                console.log(p.teamid);
                $("#returnedCards").hide();

                var teamCard = $('<div class="card-deck mb-3"/>');
                teamCard.append('<div class="card bg-light"><img class="card-img-top" src="'.concat(p.imageurl).
                concat('" alt="Card image cap"> <div class="card-body text-center"><h5 class="card-title">').
                concat(p.teamcity).concat(' ').concat(p.teamname).concat('</h5><p class="card=text">').concat(p.teamabbreviation).
                concat('</p></div></div><div class="card cardSpec"><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Wins:</h5><p class="card-text">').concat(p.wins).
                concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Losses:</h5><p class="card-text">').concat(p.losses).
                concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Pts Per Games:</h5><p class="card-text">').
                concat(p.ptspergame).concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Points Against Per Game:</h5><p class="card-text">').
                concat(p.ptsagainstpergame).concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Possessions Per Game:</h5><p class="card-text">').
                concat(p.possessionspergame).concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Plus Minus Per Game:</h5><p class="card-text">').
                concat(p.plusminuspergame).concat('</p></div></div></div>'));
                 $('#temp').html(teamCard);
         });

    });


    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
       // Log the error to the console
       console.error(
           "The following error occurred: "+
           textStatus, errorThrown
       );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
       // Reenable the inputs
       $inputs.prop("disabled", false);
    });



      });

//PLAYER Text Search
  $("#playersTextSearchButt").click(function() {
          var request;
          var $form = $("#playersTextSearch");

          var $inputs = $form.find("input, select, button, textarea");
          var serializedData = $form.serialize();
          //console.log(serializedData);
          request = $.ajax({
                  url: "textPlayerSearch.php",
                  type: "get",
                  data: serializedData,
                  dataType: 'json'
              });

              // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
           // Log a message to the console
           var data = response;
           console.log(data);
           p = JSON.parse(data[0]);
           console.log(p);

           var num = p.length;
           var newCard = $('<div class="card-deck container" id="returnedCards"/>');
           for(var i = 0; i < num; i++) {
             newCard.append('<div class="col-sm-4 mb-3" ><div class="card text-center"> <img class="card-img-top" src="'.concat(p[i].imageurl.toString())
             .concat('"><div class="card-body"><h5 class="card-title">').concat(p[i].firstname).concat(' ').concat(p[i].lastname).concat('</h5><p class="card-text"> PTS/GM: ').
             concat(p[i].ptspergame.toString()).concat('<p class="card-text"> REB/GM: ').
             concat(p[i].rebpergame.toString()).concat('</p>').concat('<p class="card-text"> AST/GM: ').
             concat(p[i].astpergame.toString()).concat('</p><button type="button" class="btn btn-outline-primary seeMorePlayer" id="').concat(p[i].playerid.toString()).
             concat('"name="seeMorePlayer">See More</button></div></div></div>'));

           }
           $('#temp').html(newCard);

           $(".seeMorePlayer").on('click',function() {
             var pID = "playerID=".concat(this.id);
             console.log(pID);
             request = $.ajax({
                     url: "seeMorePlayer.php",
                     type: "get",
                     data: pID,
                     dataType: 'json'
                 });
                  //BRITTANY
                 request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    var data = response;
                    p = JSON.parse(data[0])[0];
                    console.log(p.playerid);
                    $("#returnedCards").hide();

                    var newCard = $('<div class="card-columns"/>');
                newCard.append('<div class="card bg-light"><img class="card-img-top" src="'.
                concat(p.imageurl).concat('" alt="Card image cap"><div class="card-body text-center"><h4 class="card-title">').
                concat(p.firstname).concat(' ').concat(p.lastname).concat('</h4><div><p class="card-text font-weight-bold">Current Team </p>').
                concat(p.currentteamabbrev).concat('</div><div><p class="card-text font-weight-bold">Primary Position </p> ').concat(p.primaryposition).
                concat('</div><p class="card-text font-weight-bold">Injury Status </p> ').concat(p.injurystatus).concat('</div></div>').
                concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Games Played</h5><h3 class="specNum">').
                concat(p.gamesplayed).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Pts Per Game</h5><h3 class="specNum">').
                concat(p.ptspergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FG Pct</h5><h3 class="specNum">').
                concat(p.fgpct).concat('</h3></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">2-Point FG Pct</h5><h3 class="specNum">').
                concat(p.fg2ptpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">2-Point FG Attempts Per Game</h5><h3 class="specNum">').
                concat(p.fg2ptattpergame).concat('</h5></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">3-Point FG Pct</h5><h3 class="specNum">').
                concat(p.fg3ptpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">3-Point FG Attempts Per Game</h5><h3 class="specNum">').
                concat(p.fg3ptattpergame).concat('</h5></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FG Attempts Per Game</h5><h3 class="specNum">').
                concat(p.fgattpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">True Shooting Pct</h5><h3 class="specNum">').
                concat(p.trueshootingpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FT Pct</h5><h3 class="specNum">').
                concat(p.ftpct).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">FT Attempts Per Game</h5><h3 class="specNum">').
                concat(p.ftattpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Reb Per Game</h5><h3 class="specNum">').
                concat(p.rebpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Off Reb Per Game</h5><h3 class="specNum">').
                concat(p.offrebpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Def Reb Per Game</h5><h3 class="specNum">').
                concat(p.defrebpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Ast Per Game</h5><h3 class="specNum">').
                concat(p.astpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Steals Per Game</h5><h3 class="specNum">').
                concat(p.stlpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Blocks Per Game</h5><h3 class="specNum">').
                concat(p.blkpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Tov Per Game</h5><h3 class="specNum">').
                concat(p.tovpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Plus Minus Per Game</h5><h3 class="specNum">').
                concat(p.plusminuspergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Min Played Per Game</h5><h3 class="specNum">').
                concat(p.minutesplayedpergame).concat('</h3></div></div>').concat('<div class="card bg-light"><div class="card-body text-center"><h5 class="specTit card-title">Player Efficiency Rating</h5><h3 class="specNum">').
                concat(p.per).concat('</h3></div></div></div>'));

                $('#temp').html(newCard );

             });

        });
      });

        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
           // Log the error to the console
           console.error(
               "The following error occurred: "+
               textStatus, errorThrown
           );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function () {
           // Reenable the inputs
           $inputs.prop("disabled", false);
        });



          });

//TEAM Text Search
  $("#teamTextSearchButt").click(function() {
            var request;
            var $form = $("#teamTextSearch");

            var $inputs = $form.find("input, select, button, textarea");
            var serializedData = $form.serialize();
            //console.log(serializedData);
            request = $.ajax({
                    url: "textTeamSearch.php",
                    type: "get",
                    data: serializedData,
                    dataType: 'json'
                });

                // Callback handler that will be called on success
          request.done(function (response, textStatus, jqXHR){
             // Log a message to the console
             var data = response;
             p = JSON.parse(data[0]);

             //console.log(p)
             // console.log(p[0].imageurl.toString());
             // console.log(p[1].imageURL.toString());
             var num = p.length;
             var newCard = $('<div class="card-deck container" id="returnedCards" />');
             for(var i = 0; i < num; i++) {
               newCard.append('<div class="col-sm-4 mb-3"><div class="card text-center" id="'.concat(p[i].teamid).concat('"> <img class="card-img-top" src="').concat(p[i].imageurl.toString())
               .concat('"><div class="card-body"><h5 class="card-title">').concat(p[i].teamcity).concat(' ').concat(p[i].teamname).concat('</h5><p class="card-text"> Wins: ').
               concat(p[i].wins.toString()).concat('<p class="card-text"> Losses: ').
               concat(p[i].losses.toString()).concat('</p>').concat('<p class="card-text"> Plus-Minus/Game: ').
               concat(p[i].plusminuspergame.toString()).concat('</p><button type="button" class="btn btn-outline-primary seeMoreTeam" id="').concat(p[i].teamid.toString()).
               concat('"name="seeMoreTeam">See More</button></div></div></div>'));

             }
             $('#temp').html(newCard);
             //BRITTANY
             $(".seeMoreTeam").on('click',function() {
               var tID = "teamID=".concat(this.id);
               request = $.ajax({
                       url: "seeMoreTeam.php",
                       type: "get",
                       data: tID,
                       dataType: 'json'
                   });

                   request.done(function (response, textStatus, jqXHR){
                      // Log a message to the console
                      var data = response;
                      p = JSON.parse(data[0])[0];
                      $("#returnedCards").hide();
                      //console.log(data[0]);

                      var teamCard = $('<div class="card-deck m-3"/>');
                      teamCard.append('<div class="card bg-light"><img class="card-img-top" src="'.concat(p.imageurl).
                      concat('" alt="Card image cap"> <div class="card-body text-center"><h5 class="card-title">').
                      concat(p.teamcity).concat(' ').concat(p.teamname).concat('</h5><p class="card=text">').concat(p.teamabbreviation).
                      concat('</p></div></div><div class="card cardSpec"><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Wins:</h5><p class="card-text">').concat(p.wins).
                      concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Losses:</h5><p class="card-text">').concat(p.losses).
                      concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Pts Per Games:</h5><p class="card-text">').
                      concat(p.ptspergame).concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Points Against Per Game:</h5><p class="card-text">').
                      concat(p.ptsagainstpergame).concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Possessions Per Game:</h5><p class="card-text">').
                      concat(p.possessionspergame).concat('</p></div></div><div class="card bg-light"><div class="card-body text-center"><h5 class="card-title">Plus Minus Per Game:</h5><p class="card-text">').
                      concat(p.plusminuspergame).concat('</p></div></div></div>'));
                       $('#temp').html(teamCard);

               });

          });



          });

          // Callback handler that will be called on failure
          request.fail(function (jqXHR, textStatus, errorThrown){
             // Log the error to the console
             console.error(
                 "The following error occurred: "+
                 textStatus, errorThrown
             );
          });

          // Callback handler that will be called regardless
          // if the request failed or succeeded
          request.always(function () {
             // Reenable the inputs
             $inputs.prop("disabled", false);
          });



        });




});
</script>


  <div class="container">


    <br>
    <div class="row">
    <div class="col-sm-1"></div>
    <button type="button" class="btn btn-primary btn-lg m-2 col-sm-5" id="playNav">Search Players</button>
    <button type="button" class="btn btn-outline-primary btn-lg m-2 col-sm-5" id="playNavInact">Search Players</button>
    <button type="button" class="btn btn-primary btn-lg m-2 col-sm-5" id="teamNav" >Search Teams</button>
    <button type="button" class="btn btn-outline-primary btn-lg m-2 col-sm-5" id="teamNavInact" >Search Teams</button>
    <div class="col-sm-1"></div>

  </div>

        <br>


  <div id="homePlayers">
    <form class="row" id="playersTextSearch">
        <div class="input-group col-sm-12">
          <input type="text" class="form-control" placeholder="First Name" name="playerFirst" id="playerFirst">
          <input type="text" class="form-control" placeholder="Last Name" name="playerLast" id="playerLast">
          <input type="text" class="form-control" placeholder="Team" name="playerTeam" id="playerTeam">
          <select class="custom-select" name="playerPos" id="playerPos">
              <option selected>Position</option>
              <option value="C">Center</option>
              <option value="PF">Power Forward</option>
              <option value="SF">Small Forward</option>
              <option value="SG">Shooting Guard</option>
              <option value="PG">Point Guard</option>
            </select>
          <div class="input-group-append" id="button-addon4">
            <button class="btn btn-outline-primary" type="button" id="playersTextSearchButt">Search Players</button>
          </div>

        </div>




    </form>
    <br>

  <form id="playerStatComp" class="row">
    <div class="input-group mb-3 col-sm-4">
      <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Statistic</label>
              </div>
              <select class="custom-select" name="inputGroupSelectStats" id="inputGroupSelectStats">
                  <option selected>Choose...</option>
                  <option value="gamesPlayed">Games Played</option>
                  <option value="fgAttPerGame">Field Goals Attempted/Game</option>
                  <option value="fgPct">Field Goal Percentage</option>
                  <option value="fg2PtAttPerGame">2-Point Field Goals Attepmted/Game</option>
                  <option value="fg2PtPct">2-Point Field Goal Percentage</option>
                  <option value="fg3PtAttPerGame">3-Point Field Goals Attempted/Game</option>
                  <option value="fg3PtPct">3-Point Field Goal Percentage</option>
                  <option value="ftAttPerGame">Free Throw Attepmts/Game</option>
                  <option value="ftPct">Free Throw Percentage</option>
                  <option value="rebPerGame">Rebounds/Game</option>
                  <option value="offRebPerGame">Offensive Rebounds/Game</option>
                  <option value="defRebPerGame">Defensive Rebounds/Game</option>
                  <option value="astPerGame">Assists/Game</option>
                  <option value="ptsPerGame">Points/Game</option>
                  <option value="tovPerGame">Turnovers/Game</option>
                  <option value="stlPerGame">Steals/Game</option>
                  <option value="blkPerGame">Blocks/Game</option>
                  <option value="plusMinusPerGame">Plus Minus/Game</option>
                  <option value="minutesPlayedPerGame">Minutes Played/Game</option>
                  <option value="trueShootingPct">True Shooting Percentage</option>
                  <option value="PER">Player Efficiency Rating</option>
                </select>
    </div>

    <div class="input-group mb-3 col-sm-4">
                  <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Comparator</label>
                          </div>
                            <select class="custom-select" name="inputGroupSelectComp" id="inputGroupSelectComp">
                                <option selected>Choose...</option>
                                <option value="<">Less Than</option>
                                <option value="<=">Less Than or Equal to</option>
                                <option value="=">Equal</option>
                                <option value=">">Greater Than</option>
                                <option value=">=">Greater Than or Equal to</option>
              </select>
      </div>

      <div class="input-group mb-3 col-sm-4">
            <input type="number" max="200" class="form-control" placeholder="Number" name="statInput" id="statInput">
              <div class="input-group-append">
              <button class="btn btn-outline-primary" type="button" id="statCompPlayerSearch">Search</button>
              </div>
        </div>
  </form>





  <br>



</div>


<div id="homeTeams">
  <form class="row" id="teamTextSearch">
      <div class="input-group col-sm-12">
        <input type="text" class="form-control" placeholder="City" name="teamCity" id="teamCity">
        <input type="text" class="form-control" placeholder="Team Name" name="teamName" id="teamName">
        <div class="input-group-append" id="button-addon4">
          <button class="btn btn-outline-primary" type="button" id="teamTextSearchButt">Search Teams</button>
        </div>

      </div>

  </form>
<br>

<form id="teamStatComp" class="row">
<div class="input-group mb-3 col-sm-4">
  <div class="input-group-prepend">
      <label class="input-group-text" for="inputGroupTSelect01">Statistic</label>
          </div>
          <select class="custom-select" name="inputGroupTSelectStats" id="inputGroupTSelectStats">
              <option selected>Choose...</option>
              <option value="ptsPerGame">Points/Game</option>
              <option value="ptsAgainstPerGame">Points Against/Game</option>
              <option value="wins">Wins</option>
              <option value="losses">Losses</option>
              <option value="plusMinusPerGame">Plus Minus/Game</option>
              <option value="fgAttPerGame">Field Goals Attempted/Game</option>
              <option value="possessionsPerGame">Possessions/Game</option>
            </select>
</div>

<div class="input-group mb-3 col-sm-4">
              <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupTSelect01">Comparator</label>
                      </div>
                        <select class="custom-select" name="inputGroupTSelectComp" id="inputGroupTSelectComp">
                            <option selected>Choose...</option>
                            <option value="<">Less Than</option>
                            <option value="<=">Less Than or Equal to</option>
                            <option value="=">Equal</option>
                            <option value=">">Greater Than</option>
                            <option value=">=">Greater Than or Equal to</option>
          </select>
  </div>

  <div class="input-group mb-3 col-sm-4">
        <input type="number" max="200" class="form-control" placeholder="Number" name="statTInput" id="statTInput">
          <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" id="statCompTeamSearch">Search</button>
          </div>
    </div>
</form>




<br>



</div>






<div id="temp" ></div>




</div>
</div>


</body>
</html>
