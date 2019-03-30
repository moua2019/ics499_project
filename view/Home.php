<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Franklin Ortega
 * Initial version on: 2019-02-13 20:00
 *
 * Last update by:
 * Last update on:
 */
    session_start();

    $pageTitle = "Home";
    include "Header.php";
    include "Navigation.php";
    include "../model/Leader.php";

//    $leaderObj = new Leader();
?>

<!-- Header -->
<header class="flip-container flip-bg-gradient-red flip-center" style="padding:128px 16px">

    <!-- Icon links. If more icon links are added, it needs to change space -->
    <!-- each icon occupy 1 spaces out of 12 grid -->
    <div class="flip-col l12 m12 flip-hide-small ">
        <!-- ---- To add new icon copy this portion and make changes accordingly ---- -->
        <div class="flip-icon-container flip-col l1 flip-center space-l-5-half space-m-5-half">
            <img class="flip-circle flip-card-4 flip-icon-image" src="../images/volleball-ball.jpeg" ></a>
            <div class="flip-icon-middle">
                <a href="VolleyBallSignUp.php" class="flip-icon-middle-text">Sign Up</a>
            </div>
        </div>
        <!-- ---------------------- End of icon link portion ------------------------ -->

        <?php
//            include_once "../controller/UserController.php";
//            $controllerObj = new UserController();
//            echo empty($controllerObj->leaderUsernameExists('leader3name') ) ? "user doesn't exists!" : $controllerObj->leaderUsernameExists('leader5name');
        ?>

    </div>
    <!-- End of Icon Links -->

    <p class="flip-margin flip-bolder flip-xxxlarge flip-bottombar ">Sports Team League Registration</p>
    <a href="SignIn.php" class="flip-button flip-black flip-padding-large flip-large flip-margin-top flip-bold flip-card-2">SIGN IN</a>
    <div class="flip-small flip-margin-top flip-bold ">
        <a class="flip-hover-text-white flip-text-no-decoration flip-hover-text-light-blue" href="AdminLogin.php">Admin Login</a>
    </div>
</header>

<!-- First Grid -->
<div class="flip-row-padding flip-padding-32 flip-container" id="text"
     style="text-align: justify;text-justify: inter-word;">
    <div class="flip-padding flip-margin-right">
        <div class="flip-twothird flip-padding">
            <h1>League Information</h1>
            <h5 class="flip-padding-32">XYZ Sports, Volleyball is a league dedicated to “Creating Competitive Athletes” by building each player’s self-esteem, teaching each player the physical and mental fundamentals of the game, giving each player equal playing time, teaching good sportsmanship and the value of playing as a team. </h5>
            <p><br class="flip-text-grey"><b>WHERE:</b> Practices & Games will be held at Rolling Meadows Center - Court 1A
                <br><b>WHEN:</b> We have two seasons each year
                Spring Season runs from March-May
                Fall Season runs from October-August
                <br><b>AGES:</b> 18+
                <br><b>REGISTRATION FEE:</b> $25 per player
                <br><em>*Space is limited and registration will be taken on a first-come, first-serve basis.*</em>
            <br><b>REGISTRATION:</b></br> Registration will end once a division is full. League Apps will start a waiting list once a division is full. Each division will vary on how fast it fills up, so it is best to secure your spot early.</p>
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
            <p class="flip-text-grey">The objective of the game is to legally return the ball over the net in such a manner that the opponent’s team cannot make a legal return. The main causes of illegal plays are: holding, carrying, or lifting with the palm of the hands, four touches on one side, and two consecutive touches by one player. A regulation game is played with six players on the court. They are to rotate to serve in a clockwise direction when facing the net. The server will come from the right front position, serve, then play the right back position..<br>
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
    </div>linda h. moua - test3
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
</script>

</body>
</html>
