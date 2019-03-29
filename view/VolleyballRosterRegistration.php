<?php
/**
 * Project: ics499_project
 *
 * VolleyballRosterRegistration.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-24 23:57
 *
 * Last update by:
 * Last update on:
 */

session_start();

// Constant array for Volleyball Positions
define('VOLLEYBALL_POSITIONS', array(
    'opposite',
    'outside hitter',
    'libero',
    'setter',
    'right side hitter',
    'middle blocker'
));

if (!isset($_SESSION['temp_roster_name'])) {
    // Redirect leader to VolleyBallSignUp.php
    header('location: "VolleyBallSignUp.php');

    exit();
} else {

    $pageTitle = "TeamRegistration";
    include "Header.php";
    include "Logo.php";

    // Team name
    $teamName = $_SESSION['temp_roster_name'];

    // To display sign up error message to user
    $signup_error_msg = "";

    // Display Roster form. Players signup
    echo "
        <div class=\"flip-content flip-container flip-centered flip-col l6 space-l-3 m8 space-m-2 s10 space-s-1 flip-card-4 flip-margin-bottom\" >
            <div class=\"flip-container flip-col s12\">
                <h2 class='flip-center flip-bolder'>Volleyball Sign Up</h2>
                <p class='flip-small flip-text-red'>$signup_error_msg</p>
                <form action='../model/ValidateRosterRegistration.php' method='post' >
                    <p class='flip-center flip-padding-small flip-large'>Your Team Name: 
                            <i class='flip-bolder flip-blue-499 flip-padding-small flip-round-medium '>$teamName</i></p>
                    <p class='flip-center flip-green flip-padding-small'>Players Information</p>";

    $plyrArray = array();

    // To display 6 players
    for ($i = 1; $i <= 6; $i++) {
        $position = VOLLEYBALL_POSITIONS[$i - 1];
        echo " 
                    <p class=\"flip-left flip-light-green flip-small flip-margin-top \" style=\"width: 100%; margin-bottom: 5px;\">Player $i &emsp; " . strtoupper($position) . "</p>
                    
                    <!-- -16 and margin '0' is to display all fields using the whole grid -->
                    <div class=\"flip-row-padding\" style=\"margin:0 -16px;\">  
                        <div class=\"flip-col l3 m3  flip-small\">
                            <input class=\"flip-input playerFname flip-border\" type=\"text\"  placeholder=\"First Name\" name=\"plyrFnameArray[]\" required>
                        </div>
                        <div class=\"flip-col l3 m3  flip-small\">
                            <input class=\"flip-input playerLname flip-border\" type=\"text\"  placeholder=\"Last Name\"  name=\"plyrLnameArray[]\" required>
                        </div>
                        <div class=\"flip-col l3 m3  flip-small\">
                            <input class=\"flip-input playerPhone flip-border\" type=\"tel\"  maxlength=\"10\" placeholder=\"Phone\" name=\"plyrPhoneArray[]\" required>
                        </div>
                        <div class=\"flip-col l3 m3  flip-small\">
                            <input class=\"flip-input playerShirt flip-border\" type=\"number\"  placeholder=\"T-shirt Number\" name=\"plyrShirtArray[]\" required>
                        </div>
                        <input type='hidden' name='positionArray[]' value=\"$position\">
                    </div>
        ";
    } // End of loop


    echo "
                    <input type='hidden' name='sport_type' value='Volleyball'>
                    <input type='hidden' name='total_players' value='6'> 
                    <div class=\"flip-col flip-center flip-margin-top flip-bottombar\" style=\"margin-bottom: 15px !important;\">
                <!--        <button class=\"flip-hover-green flip-round-large flip-black flip-padding flip-center flip-margin-bottom\"  type=\"submit\" id='submitBttn' name=\"register\" value=\"signup\" disabled>SIGN UP</button>
                 -->       <button class=\"flip-hover-green flip-round-large flip-black flip-padding flip-center flip-margin-bottom\"  type=\"submit\" id='submitBttn' name=\"register\" value=\"signup\" >SIGN UP</button>
                    
                    </div>
                </form>
                <div class=\"flip-small flip-bar-item flip-clear flip-center flip-margin-bottom\">
                    <a class=\"flip-small flip-bar-item flip-hover-text-red \" href=\"Cancel.php\" style=\"text-decoration: none !important\">
                        <i class=\"flip-animate-left\">Cancel</i>
                    </a>
                    <a class=\"flip-small flip-bar-item flip-hover-text-green flip-margin-left\" href=\"Logout.php\" style=\"text-decoration: none !important\">
                        <i class=\"flip-animate-left\">Logout</i>
                    </a>
                </div>
            </div>
        </div>
    ";

} // End of if{} else{}

?>

<script>
    // const plyrFname = document.getElementsByClassName('playerFname');
    // const plyrLname = document.getElementsByClassName('playerLname');
    // const plyrPhone = document.getElementsByClassName('playerPhone');
    // const plyrShirt = document.getElementsByClassName('playerShirt');
    // const submitBttn  = document.getElementById('submitBttn');
    //
    // for(let i = 0; i < plyrShirt.length; i++)
    // {
    //     let isValidShirt = true;
    //     let n = 0;
    //     plyrShirt[i].addEventListener('keyup', function (event) {
    //         let value = plyrShirt[i].value;
    //         let reg = new RegExp('^\\d+$');
    //         isValidShirt =  !value.match(reg);
    //
    //         // plyrFname[i].style.backgroundColor = 'red';
    //     });
    //
    //     isValidShirt ? plyrFname[i].style.backgroundColor = 'red' : ;
    //     submitBttn.disabled = isValidShirt; // If all fields are valid  disable will be false
    // }


</script>
