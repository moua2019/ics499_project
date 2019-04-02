<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Franklin Ortega
 * Initial version on: 2019-02-18 23:41
 *
 * Last update by:
 * Last update on:
 */

$pageTitle = "SignUp";
include "Header.php";
include "Logo.php";
include "../controller/UserController.php";
include_once "../utilities/CleanData.php";
include_once "../model/CreateUniqueId.php";

// To display sign up error message to user
$signup_error_msg = "";

//if (isset($_POST))
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // To register a Leader
    if ($_POST["register"] === "signup"){
        // Instantiate CleanData class
        $cleanup_object = new CleanData();

        // Trim all incoming data
        $trimmed = array_map('trim', $_POST);

        // Create an error array
        $signupErrorArr = array();

        // Clean up data
        // First Name
        if (!empty($trimmed['fName'])){
            $first_name = $cleanup_object->getVarClean($trimmed['fName']);
        } else {
            $first_name = false;
            $signupErrorArr[] = "First Name cannot be empty";
        }
        // Last Name
        if (!empty($trimmed['lName'])){
            $last_name = $cleanup_object->getVarClean($trimmed['lName']);
        } else {
            $last_name = false;
            $signupErrorArr[] = "Last Name cannot be empty";
        }
        // Username
        if (!empty($trimmed['userName'])){
            $username = $cleanup_object->getVarClean($trimmed['userName']);
        } else {
            $username = false;
            $signupErrorArr[] = "Username cannot be empty";
        }
        // Password (pwd)
        if (!empty($trimmed['pwd'])){
            $password = $cleanup_object->getVarClean($trimmed['pwd']);
        } else {
            $password = false;
            $signupErrorArr[] = "Password cannot be empty";
        }
        // email
        if (!empty($trimmed['email'])){
            $email = $cleanup_object->getVarClean($trimmed['email']);
        } else {
            $email = false;
            $signupErrorArr[] = "Email cannot be empty";
        }
        // phone
        if (!empty($trimmed['phone'])){
            $phone = $cleanup_object->getVarClean($trimmed['phone']);
        } else {
            $phone = false;
            $signupErrorArr[] = "Phone cannot be empty";
        }

        // If all fields are filled and username is unique register Leader
        if (empty($signupErrorArr)){

            $controller = new UserController();

            // When registering, Leader has no team id. So it is empty
            $empty_leader_team_id = "";

            // Create a unique id for leader
            $createIdObj = new CreateUniqueId();
            $leader_id = $createIdObj->getUniqueId($first_name, $last_name);

            // Verify if username is not taken.
            if (!empty($controller->leaderUsernameExists($username))) {
                $signup_error_msg = "Username \"$username\" exists, please choose a different one.";
            } else {
                $redirect = $controller->registerLeader($leader_id, $first_name, $last_name, $username, $email, $phone, $password, $empty_leader_team_id);
                header("location: $redirect");
            }
        } else if (!empty($signupErrorArr)) {
            // Display errors
            foreach ($signupErrorArr as $error){
                $signup_error_msg .= $error . "<br>";
            }
        }
    } // End of Leader Signup

} // End of Request POST

echo"
    <div class=\"flip-content flip-container flip-centered flip-col l4 space-l-4 m6 space-m-3 flip-card-4 flip-margin-bottom flip-padding-large\" >
        <div class=\"flip-container flip-col l12 m12 s12\">
            <h2 class='flip-center'>Sign Up</h2>
            <p class='flip-small flip-text-red'>$signup_error_msg</p>
            <form action='LeaderSignUp.php' method='post' >
                <div class=\"flip-margin-top\">
                    <input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"First Name\" name=\"fName\" required='required'>
                </div>
                <div class=\"flip-margin-top\">
                    <input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"Last Name\" required name=\"lName\" >
                </div>
                <div class=\"flip-margin-top\">
                    <input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"Username\" required name=\"userName\" > 
                </div>
                <div class=\"flip-margin-top\">
                    <input class=\"flip-input flip-padding-small flip-border\" type=\"password\" placeholder=\"Password\" required name=\"pwd\">
                </div>
                <div class=\"flip-margin-top\">
                    <input class=\"flip-input flip-padding-small flip-border\" type=\"email\" placeholder=\"Email\" required name=\"email\" >
                </div>
                <div class=\"flip-margin-top\">
                    <input class=\"flip-input flip-padding-small flip-border\" type=\"tel\" maxlength=\"10\" placeholder=\"Phone\"  name=\"phone\" >
                </div>
                <div class=\"flip-center flip-margin-top\">
                    <button class=\"flip-hover-green flip-black flip-padding\" type=\"submit\" name=\"register\" value=\"signup\">SIGN UP</button>
                </div>
            </form>
            <div class=\"flip-margin-bottom flip-margin-top\">
                <a class='flip-small flip-bar-item flip-hover-text-green flip-left flip-animate-right' href='Home.php' style='text-decoration: none !important'> Return Home</a>
                <a class='flip-small flip-bar-item flip-hover-text-green flip-right flip-animate-left'  style='text-decoration: none !important'href='SignIn.php'> Sign In</a>
            </div>
        </div>
    </div>

    <div>
        <p></p>
    </div>
";

?>

</body>
</html>
