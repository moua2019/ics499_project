<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-19 18:12
 *
 * Last update by:
 * Last update on:
 */
session_start();


// If Leader is not logged in, then redirect to SignIn page. Otherwise let
// create a Volleyball team
if (!isset($_SESSION['username'])) {
    // Redirect the user
    header("Location: SignIn.php");

    // Exit page
    exit();
} else {

    $pageTitle = "SignUp";
    include "Header.php";
    include "Logo.php";
    include "../controller/UserController.php";
    include_once "../utilities/CleanData.php";

    // To display sign up error message to user
    $signup_error_msg = "";

    //if (isset($_POST))
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // To verify if team name is available
        if ($_POST["register"] === "verify_teamName") {
            // Instantiate CleanData class
            $cleanup_object = new CleanData();

            // Instantiate UserController class
            $controller = new UserController();

            // Trim all incoming data
            $trimmed = array_map('trim', $_POST);

            // To keep track if team name exists
            $teamNameExists = false;

            // To make sure Leader enters team name
            $emptyTeamName = "";

            // Clean up data
            // Team Name
            if (!empty($trimmed['teamName'])) {
                $team_name = $cleanup_object->getVarClean($trimmed['teamName']);
            } else {
                $team_name = false;
                $emptyTeamName = "Team Name cannot be empty";
            }

            // If all fields are filled and username is unique register Leader
            if (empty($emptyTeamName)) {
                $teamNameExists = $controller->teamNameExist($team_name);

                if (!$teamNameExists) {
                    // Create a temp roster name Session variable
                    $_SESSION['temp_roster_name'] = $team_name;

                    // Redirect to PlayersRegistration
                    header("location: VolleyballRosterRegistration.php");

                    // Exit the page
                    exit();
                } else {
                    $signup_error_msg = "Team name \"$team_name\" already exist.<br>
                            Please choose a different one.";
                }
            } else {
                $signup_error_msg = $emptyTeamName;
            }
        } // End of Verify Team Name

    } // End of Request POST

    echo "
    <div class=\"flip-content flip-container flip-centered flip-col l6 space-l-3 m8 space-m-2 s10 space-s-1 flip-card-4 flip-margin-bottom\" >
        <div class=\"flip-container flip-col s12\">
            <h2 class='flip-center flip-bolder'>Volleyball Sign Up</h2>
            <p class='flip-small flip-text-red flip-center'>$signup_error_msg</p>
            <form action='VolleyBallSignUp.php' method='post' >
                <p><input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"Team Name\" name=\"teamName\" required></p>
                
                <div class=\"flip-col flip-center flip-margin-top flip-bottombar\" style=\"margin-bottom: 15px !important;\">
                    <button class=\"flip-hover-green flip-round-large flip-black flip-padding flip-center flip-margin-bottom\"  type=\"submit\" name=\"register\" value=\"verify_teamName\">SIGN UP</button>
                
                </div>
            </form>
            <div class=\"flip-small flip-bar-item flip-clear flip-center flip-margin-bottom\">
                <a class=\"flip-small flip-bar-item flip-hover-text-red \" href=\"Cancel.php\" style=\"text-decoration: none !important\">
                    <i class=\"flip-animate-left\">Can</i><i class=\"flip-animate-right\">cel</i>
                </a>
            </div>
        </div>
    </div>
";
}

?>


</body>
</html>