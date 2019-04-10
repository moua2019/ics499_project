<?php
/**
 * Project: ics499_project
 *
 * LeaderInterface.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-21 00:18
 *
 * Last update by:
 * Last update on:
 */
    session_start();

    $pageTitle = "Leader";
    include "Header.php";
    include "Navigation.php";
    include_once "../utilities/FormatPhone.php";
    include_once "../controller/UserController.php";

    // Instantiate respective classes
    $controllerObj = new UserController();
    $phoneFormatObj = new FormatPhone();

    // Display Leader's team if Leader has a team
    if (isset($_SESSION['leader_has_Team'])){
        $leader_has_team = true;
    } else {
        $teamId = $controllerObj->getLeaderTeamId($_SESSION['username']);
        if (!(empty($teamId))) {
            $_SESSION['leader_has_Team'] = true;
            $_SESSION['leader_team_id'] = $teamId;

            $leadInterface = $_SERVER['REQUEST_URI'];
            $nav = " ../view/Navigation.php";
            header("Refresh: 0; URL = $nav "); // Refresh navigation page
            header("Refresh: 0; URL = $leadInterface ");
        } else {
            $leader_has_team = false;
        }
    }

    $leaderInfoArray = $controllerObj->getLeaderInfo($_SESSION['username']);

    // Leader array is composed by First Name, Last Name, Username, Email, Phone, TeamId.
    $fName = $leaderInfoArray[0];
    $lName = $leaderInfoArray[1];
    $username = $leaderInfoArray[2];
    $email = $leaderInfoArray[3];
    $tempPhone = $leaderInfoArray[4];
    $teamId = $leaderInfoArray[5];

    // Get Team Name using teamId
    $leaderTeam = !empty($teamId) ? $controllerObj->getTeamNameByRosterId($teamId) : "No Team";

    // Format phone number if not empty
    if (empty($tempPhone)) {
        $phone = "N/A";
    } else {
        $phoneFormatObj->setFormattedNumber($tempPhone);
        $phone = $phoneFormatObj->getFormattedNumber();
    }
?>

<!-- Header -->
<header class="flip-container flip-bg-gradient-red flip-center" style="padding:70px 16px; height: 700px">
<?php echo "
    <!-- Display Leader profile-->
    <div id=\"Profile\" class=\"tabcontent\">
        <h1 class='flip-bolder'>Profile</h1>

        <div class=\"flip-col l6 space-l-3 m6 space-m-3 s10 space-s-1\">
            <table class=\"flip-table flip-striped flip-white\">
                <tr>
                    <td><i class=\"fa fa-user flip-text-blue-499 flip-large\"></i></td>
                    <td>Name:</td>
                    <td>$fName &nbsp  $lName</td>
                    <td></td>
                </tr>
                <tr>
                    <td><i class=\"fa fa-id-card flip-text-deep-blue-499 flip-large\"></i></td>
                    <td>Username:</td>
                    <td><i>$username</i></td>
                    <td><i class=\"flip-button flip-tiny flip-hover-red flip-round-medium\">Edit</i></td>
                </tr>
                <tr>
                    <td><i class=\"fa fa-envelope flip-text-deep-blue-499  flip-large\"></i></td>
                    <td>Email:</td>
                    <td>$email</td>
                    <td><i class=\"flip-button flip-tiny flip-hover-red flip-round-medium\">Edit</i></td>
                </tr>
                <tr>
                    <td><i class=\"fa fa-mobile flip-text-deep-blue-499  flip-xlarge\"></i></td>
                    <td>Phone:</td>
                    <td><i>$phone</i></td>
                    <td><i class=\"flip-button flip-tiny flip-hover-red flip-round-medium\">Edit</i></td>
                </tr>
                <tr>
                    <td><i class=\"fa fa-trophy flip-text-deep-blue-499  flip-large\"></i></td>
                    <td>Team:</td>
                    <td><i>$leaderTeam</i></td>
                    <td></td>
                </tr>
            </table>
        </div>
        
    </div>

    ";
    ?>
    <!-- Display Schedule -->
    <div id="Schedule" class="tabcontent">
        <h1>Schedule</h1>
        <p>Schedule table will go here.</p>
    </div>

    <!-- Display Games -->
    <div id="Games" class="tabcontent">
        <h1>Games</h1>
        <p>Games table will go here.</p>
    </div>

    <!-- Display Team information -->
    <div id="Team" class="tabcontent">
        <h1>Team</h1>
        <?php
        if ($leader_has_team){ // Display Team table
            echo "Display Team Table here, use leader team id to get Team information from db";
        } else { // Display registration
            echo "
                <p class='flip-clear flip-small flip-bold'>Select sport to sign up your Team. </p>
                
                <!-- ---- To add new icon copy this portion and make changes accordingly ---- -->
                <div class=\"flip-icon-container flip-col l1 flip-center space-l-5-half space-m-5-half\">
                    <img class=\"flip-circle flip-card-4 flip-icon-image\" src=\"../images/volleball-ball.jpeg\"  alt=\"Volleyball ball\"></a>
                    <div class=\"flip-icon-middle\">
                        <a href=\"VolleyBallSignUp.php\" class=\"flip-icon-middle-text\">Sign Up</a>
                    </div>
                </div>
                <!-- ---------------------- End of icon link portion ------------------------ -->
                ";
        } ?>


    </div>

</header>

<!-- First Grid -->
<div class="flip-row-padding flip-padding-32 flip-container" id="text"
     style="text-align: justify;text-justify: inter-word;">
    <div class="flip-content flip-margin-right">
        <div class="flip-twothird flip-padding">
            <h1>League Information</h1>
            <div class="flip-margin-right flip-text-dark-gray">
            <p>XYZ Sports, Volleyball is a league dedicated to “Creating Competitive Athletes” by building each player’s self-esteem, teaching each player the physical and mental fundamentals of the game, giving each player equal playing time, teaching good sportsmanship and the value of playing as a team. </p>
                <p><b>WHERE:</b> Practices & Games will be held at Rolling Meadows Center - Court 1A
                    <br><b>WHEN:</b> We have two seasons each year
                    Spring Season runs from March-May
                    Fall Season runs from October-August
                    <br><b>AGES:</b> 18+
                    <br><b>REGISTRATION FEE:</b> $25 per player
                    <br><em>*Space is limited and registration will be taken on a first-come, first-serve basis.*</em>
                    <br><b>REGISTRATION:</b></br> Registration will end once a division is full. League Apps will start a waiting list once a division is full. Each division will vary on how fast it fills up, so it is best to secure your spot early.</p>
            </div>
        </div>

        <div class="flip-third flip-center flip-margin\">
            <img src="../images/all_sports.jpeg" style="width: 100%; height: 300px">
        </div>
    </div>
</div>

<!-- Second Grid -->
<div id="volleyText" class="flip-row-padding flip-light-grey flip-padding-64 flip-container"
     style="text-align: justify;text-justify: inter-word;">
    <div class="flip-content">
        <div class="flip-third flip-center">
            <img src="../images/volleball-ball.jpeg" class="flip-circle flip-card-4">
        </div>

        <div class="flip-twothird">
            <h1>Volleyball</h1>
            <p class="flip-text-dark-grey flip-margin-left">The objective of the game is to legally return the ball over the net in such a manner that the opponent’s team cannot make a legal return. The main causes of illegal plays are: holding, carrying, or lifting with the palm of the hands, four touches on one side, and two consecutive touches by one player. A regulation game is played with six players on the court. They are to rotate to serve in a clockwise direction when facing the net. The server will come from the right front position, serve, then play the right back position..<br>
                <br>Volleyball is a team sport. The teams are separated by a large net. It has six players on each side of the net. Each team is allowed twelve substitution players. The game starts when the captain from each team decides which side of the court they will play on, by the toss of a coin, which also determines who will serve (hit) the ball first. The point of the game is to keep the ball in the air. The ball can be played with any part of the body, with a maximum of three strokes a team. If at any point the ball hits the floor, the side that the ball landed on it is a point for the other team</p>
        </div>
    </div>
</div>

<!-- Quote -->
<div class="flip-container flip-deep-blue-499 flip-text-white flip-center flip-opacity flip-padding-64">
    <h1 class="flip-margin flip-xxlarge">Practice like you've never won.<br>Perform like you've never lost</h1>
    <p class="flip-right flip-margin-right">- Mithilesh Chudgar</p>
</div>

<!-- Footer -->
<footer class="flip-container flip-padding-64 flip-center flip-opacity">
    <div class="flip-xlarge flip-padding-32">
        <i class="fa fa-facebook-official flip-hover-opacity"></i>
        <i class="fa fa-instagram flip-hover-opacity"></i>
        <i class="fa fa-snapchat flip-hover-opacity"></i>
        <i class="fa fa-pinterest-p flip-hover-opacity"></i>
        <i class="fa fa-twitter flip-hover-opacity"></i>
        <i class="fa fa-linkedin flip-hover-opacity"></i>
    </div>
</footer>

<script>
    // Used to toggle the menu on small screens when clicking on the menu button
    function myFunction() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("flip-show") == -1) {
            x.className += " flip-show";
        } else {
            x.className = x.className.replace(" flip-show", "");
        }
    }

    function openDescription(leaderNav,elmnt,color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            tabcontent[i].style.color = 'black';
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "#1C4791";
            tablinks[i].style.color = "";
        }
        document.getElementById(leaderNav).style.display = "block";
        elmnt.style.backgroundColor = color;
        elmnt.style.color = 'black';

    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

</body>
</html>
