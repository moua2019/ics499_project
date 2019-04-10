<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Pajhli Nengchu
 * Initial version on: 3/24/2019 10:13 AM
 *
 * Last update by:
 * Last update on:
 *
 */
session_start();

$pageTitle = "Admin";
include "Header.php";
include "Navigation.php";
include_once "../utilities/FormatPhone.php";
include "../controller/AdminController.php";

// Instantiate respective classes
$controllerObj = new AdminController();
$phoneFormatObj = new FormatPhone();


$adminInfoArray = $controllerObj->getAdminInfo($_SESSION['username']);

// Admin array is composed by First Name, Last Name, Username, Email, Phone.
$fName = $adminInfoArray[0];
$lName = $adminInfoArray[1];
$username = $adminInfoArray[2];
$email = $adminInfoArray[3];
$tempPhone = $adminInfoArray[4];


/*// Get Team Name using teamId
$leaderTeam = !empty($teamId) ? $controllerObj->getTeam($teamId) : "No Team";*/

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
    <?php
    echo " 
    <!-- Display Profile -->
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
            </table>
        </div>

    </div>

    ";
    ?>
    <!-- Display Schedule -->
    <div id="Schedule" class="tabcontent">
        <h1>Schedule</h1>
        <a href="http://localhost/ics499_project/schedule/">Link here</a>
    </div>

    <!-- Display Games -->
    <div id="Games" class="tabcontent">
        <h1>Games</h1>
        <p>Games table will go here.</p>
    </div>

    <!-- Display Roster -->
    <div id="Roster" class="tabcontent">
        <h1>Roster</h1>
        <p>Roster table will go here.</p>
    </div>


    <!-- Display Leader-->
    <div id="Leader" class="tabcontent">
        <h1>Leader</h1>
        <p>Leader table will go here.</p>
    </div>

</header>

<!-- First Grid -->
<div class="flip-row-padding flip-padding-32 flip-container" id="text"
     style="text-align: justify;text-justify: inter-word;">
    <div class="flip-content flip-margin-right">
        <div class="flip-twothird flip-padding">
            <h1>Welcome to the Administrator Page!</h1>

            <p class="flip-text-grey">Here you will be able to monitor the league registration system.</p>
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
            <h5 class="flip-padding-32">Updates:</h5>

            <p class="flip-text-grey">Summer classes start soon!</p>
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

    function openDescription(adminGrid,elmnt,color) {
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
        document.getElementById(adminGrid).style.display = "block";
        elmnt.style.backgroundColor = color;
        elmnt.style.color = 'black';

    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

</body>
</html>
