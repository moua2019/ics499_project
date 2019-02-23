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

    $pageTitle = "Home";
    include "../utilities/Header.php";
    include "../utilities/Navigation.php";
    include "../model/Leader.php";

    $leaderObj = new Leader();
    if (isset($_SESSION['leader_has_Team'])){
        $leader_has_team = true;
        $leaderTeamId = empty($_SESSION['leader_has_Team']);
    } else {
        $leader_has_team = false;
    }
?>

<!-- Header -->
<header class="flip-container flip-bg-gradient-red flip-center" style="padding:128px 16px; height: 700px">

    <div id="Profile" class="tabcontent">
        <h1>Profile</h1>
        <p>Leader information will go here with update option.</p>
    </div>

    <div id="Schedule" class="tabcontent">
        <h1>Schedule</h1>
        <p>Schedule table will go here.</p>
    </div>

    <div id="Events" class="tabcontent">
        <h1>Events</h1>
        <p>Events table will go here.</p>
    </div>

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
            <h5 class="flip-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

            <p class="flip-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat.</p>
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
            <h5 class="flip-padding-32">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h5>

            <p class="flip-text-grey">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint
                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                laboris nisi ut aliquip ex ea commodo consequat.</p>
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

    function openDescription(cityName,elmnt,color) {
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
        document.getElementById(cityName).style.display = "block";
        elmnt.style.backgroundColor = color;
        elmnt.style.color = 'black';

    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

</body>
</html>
