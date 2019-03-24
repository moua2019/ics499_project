<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Pajhli Nengchu
 * Initial version on: 2019-02-20 10:27
 *
 * Last update by: 3/23/19
 * Last update on:
 */

session_start();

$pageTitle = "AdminLogin";
include "Header.php";
include 'Logo.php';


$loginErrorMesg = "";
$loginMessageColor = "flip-text-red";
$alignment = "";
//$sign_up_str = "<a class=\"flip-small flip-bar-item flip-hover-text-green flip-animate-left $\"  style=\"text-decoration: none !important\" href='LeaderSignUp.php'> Sign Up</a>";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Create an instance of the CleanData.php class
    include_once "../utilities/CleanData.php";
    $cleanClass = new CleanData();

    // To store login errors
    $loginErrors = array();

    // Trim all incoming data
    $trimmed = array_map('trim', $_POST);

    /* Login */
    if ($_POST['submit'] === "Sign In") {

        // Check for user name
        if (!empty($trimmed['userName'])) {
            $user_name = $cleanClass->getVarClean($trimmed['userName']);
        } else {
            $user_name = false;
            $loginErrors[] = 'Please enter your username';
        }

        // Validate password
        if (!empty($trimmed['pwd'])) {
            $pass = $cleanClass->getVarClean($trimmed['pwd']);
        } else {
            $pass = false;
            $loginErrors[] = "Please enter your password";
        }

        // If no empty user name or password
        if ($user_name and $pass) {
            // Instantiate class AdminController
            include_once "../controller/AdminController.php";
            $controllerObj = new AdminController();

            // If Leader username exists, verify user's password input
            if (!empty($controllerObj->adminUsernameExists($user_name))) {
                // Verify password
                $admin = $controllerObj->getAdmin($user_name);

                // Check if password user's input is correct, if so, sign in and create session variables.
                if ($controllerObj->verifyAdminPass($user_name, $pass)) {
                    // Set session variables
                    $_SESSION['username'] = $admin->getAdminUsername();

                    $_SESSION['first_name'] = $admin->getAdminFirstName();
                    $_SESSION['user_type'] = "admin";

                    echo "Session username:" . $_SESSION['username'];

                    // Redirect admin
                    header("Location: AdminInterface.php");

                    // Exit page when it is done
                    exit();
                } else {
                    $loginErrorMesg = "Invalid Password";
                }

            } else {
                $loginErrorMesg = $user_name . " is not registered.";
            }
        } // End of if no empty user input

    } // End of if POST = submit
    else {
        echo "Submit not working";
    }


}
if (!isset($_SESSION['adminUsername']) ) {
    $temp_user = isset($user_name) ? $user_name : "";
    echo "
    <div class=\"flip-content flip-container flip-col l4 space-l-4 m6 space-m-3 flip-card-4 flip-margin-top\" >
        <div class=\"flip-container flip-col l12 \">
            <h2 class='flip-center'>Sign In</h2>
            <div class=\"$loginMessageColor flip-small flip-center\">$loginErrorMesg</div>
            <form action=\"AdminLogin.php\" method=\"POST\">
                  <p><input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"Username\" value='$temp_user' required name=\"userName\"></p>
                  <p><input class=\"flip-input flip-padding-small flip-border\" type=\"password\" placeholder=\"Password\" required name=\"pwd\"></p>
                  <p><input class=\"flip-black flip-hover-green flip-padding-large\" style='text-align: center; width: 50%!important; margin-left: 25%' 
                                type=\"submit\" name=\"submit\" value='Sign In'></p>
            </form>
            <div class=\"flip-padding-small flip-margin-bottom flip-center\">
                <a class='flip-small flip-bar-item flip-hover-text-green flip-center ' href='Home.php' style='text-decoration: none !important'><i class='flip-animate-left'>Return to</i> <i class='flip-animate-right'>home page</i></a>
            </div>
        </div>
      </div>
    ";}
