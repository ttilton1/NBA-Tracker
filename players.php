<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
</style>
<?php
include("/etc/php/pdo-nba.php");
$dbh = dbconnect();
?>
</head>

<body>

<!-- <?php
$st = $dbh->query("SELECT firstName, lastName FROM playerstable");
while ($myrow = $st->fetch()) {
    echo $myrow['firstname'] . ' ' . $myrow['lastname'];
}
?>

<?php
$st = $dbh->query("SELECT playerid FROM playerstable");
$playerids = $st->fetchall();
?> -->

<script>
var playerids = <?php echo json_encode($playerids) ?>;

$(document).ready(function(){
  var statsSelection = null;

    $("#home").click(function(){
        $("#players").hide();
        $("#teams").hide();
    });
    $("#players").click(function(){
      $("#home").hide();
      $("#teams").hide();
    });
    $("#teams").click(function(){
      $("#players").hide();
      $("#home").hide();
    });
    $("#inputGroupSelectStats").change(function() {
        $("#home").data("statsSelection", $(this).val());
          console.log($("#home").data("statsSelection"));
      });



});
</script>



  <div class="container">
    <br>
        <nav class="nav nav-pills nav-fill m-t-3">
          <li class="nav-item"><a class ="nav-link active" href="#">Home</a></li>
            <li class="nav-item"><a class ="nav-link" href="#">Players</a></li>
              <li class="nav-item"><a class ="nav-link" href="#">Teams</a></li>
          </nav>
        <br>


    <div id="home">
    <div class="row">
        <div class="input-group col-sm-12">
          <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon4">
          <div class="input-group-append" id="button-addon4">
            <button class="btn btn-outline-primary" type="button">Search Players</button>
            <button class="btn btn-outline-primary" type="button">Search Teams</button>
          </div>
        </div>


    </div>
    <br>

    <div id="homeInputDrop" class="row">
    <div class="input-group mb-3 col-sm-4">
      <div class="input-group-prepend" id="jdb">
          <label class="input-group-text" for="inputGroupSelect01">Statistic</label>
              </div>
                <select class="custom-select" id="inputGroupSelectStats">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
    </div>

    <div class="input-group mb-3 col-sm-4">
                  <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Comparator</label>
                          </div>
                            <select class="custom-select" id="inputGroupSelectComp">
                                <option selected>Choose...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                      <option value="3">Three</option>
              </select>
      </div>

      <div class="input-group mb-3 col-sm-4">
  <input type="number" max="200" class="form-control" placeholder="Number" aria-label="Number" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-outline-primary" type="button" id="button-addon2">Search</button>
  </div>
</div>
    </div>









  <br>

  



<br><br>
  <div class="card-deck">
    <div class="card" title="Title" img-src="http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/6442.png&w=350&h=254" img-alt="PLAYER NAME" img-top>
      <p class="card-text">
        PTS/GM: XX.xx
      </p>
      <p class="card-text">
        REB/GM: XX.xx
      </p>
      <p class="card-text">
        ASS/GM: XX.xx
      </p>
      <button type="button" class="btn btn-outline-secondary">See More</button>

    </div class="card">
    <div class="card" title="Title" img-src="http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/4065648.png&w=350&h=254" img-alt="PLAYER NAME" img-top>
      <p class="card-text">
        PTS/GM: XX.xx
      </p>
      <p class="card-text">
        REB/GM: XX.xx
      </p>
      <p class="card-text">
        ASS/GM: XX.xx
      </p>
      <button type="button" class="btn btn-outline-secondary">See More</button>

    </div class="card">
    <div class="card" title="Name" img-src="http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/4277848.png&w=350&h=254" img-alt="PLAYER NAME" img-top>
      <p class="card-text">
        PTS/GM: XX.xx
      </p>
      <p class="card-text">
        REB/GM: XX.xx
      </p>
      <p class="card-text">
        ASS/GM: XX.xx
      </p>
      <button type="button" class="btn btn-outline-secondary">See More</button>

    </div class="card">
</div class="card-deck">


</div>









</div>
</div>



<script>
import mysportsfeeds from 'mysportsfeeds-node'
var mysf = require("mysportsfeeds-node");
var conString = "postgres://vagrant:vagrant@localhost:5432/shared/nba-admin";
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
export default {
  name: 'app',

  data() {
    return {
      pd: null,
      ret: '',
      statSelect: 'Statistic',
      compSelect: 'Comparator',
      statIn: '',
      isHomeActive: true,
      isPlayerActive: false,
      isTeamActive: false
    }
  },
  methods: {
    playersClick: function() {
      isHomeActive =false;
      isTeamActive=false;
      isPlayerActive=true;
    }

  },
  created: function() { //part of lifecycle hook for vue so occurs at beginning
    var msf = new mysportsfeeds("2.0", true, null);
    msf.authenticate("188046c3-71dd-4568-ba90-338174", "MYSPORTSFEEDS");
    // var resp = msf.getData('nba', 'current', 'cumulative_player_stats', 'json', {
    //     force: 'true'
    // });
    var resp = msf.getData('nba', 'current', 'seasonal_player_stats', 'json', {

      force: 'true'
    });

    resp.then((data) => {
      this.pd = data;
    });







  }
}
</script>


</body>
</html>
