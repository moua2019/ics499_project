<?php
session_start();
/**
 * Project: ics499_project
 *
 * Initial version by: Franklin Ortega
 * Initial version on: 2019-02-19 14:15
 *
 * Last update by:
 * Last update on:
 */

$pageTitle = "SignIn";
include "../utilities/Header.php";
include '../utilities/Logo.php';

$loginErrorMesg = "";
$loginMessageColor = "flip-text-red";
$alignment = "";
$sign_up_str = "<a class=\"flip-small flip-bar-item flip-hover-text-green flip-animate-left $\"  style=\"text-decoration: none !important\" href='LeaderSignUp.php'> Sign Up</a>";


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
            // Instantiate class leader
            include_once "../model/Leader.php";
            $leaderObj = new Leader();

            // If leader username exists
            if ($leaderObj->getLeaderUserName($user_name) != NO_MATCH_FOUND) {
                // Verify password
                if ($leaderObj->verifyLeader($pass)) {
                    // Set session variables
                    $_SESSION['user'] = $leaderObj->getLeaderUserName($user_name);
                    $_SESSION['leader_has_Team'] = $leaderObj->getLeaderTeamId($user_name);
                    $_SESSION['user_type'] = "leader";

                    // Redirect the user
                    header("Location: LeaderInterface.php");

                    // Exit page when it is done
                    exit();
                } else {
                    $loginErrorMesg = "Invalid Password";
                }

            } else {
                $loginErrorMesg = $user_name . " is not registered,<br>Please $sign_up_str";
            }
        } // End of if no empty user input


    } // End of if POST = submit
    else {
        echo "Submit not working";
    }


}
if (!isset($_SESSION['leaderUsername']) or !isset($_SESSION['adminUsername'])) {
    $temp_user = isset($user_name) ? $user_name : "";
    echo "
    <div class=\"flip-content flip-container flip-col l4 space-l-4 m6 space-m-3 flip-card-4 flip-margin-top\" >
        <div class=\"flip-container flip-col l12 \">
            <h2 class='flip-center'>Sign In</h2>
            <div class=\"$loginMessageColor flip-small flip-center\">$loginErrorMesg</div>
            <form action=\"SignIn.php\" method=\"POST\">
                  <p><input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"User Name\" value='$temp_user' required name=\"userName\"></p>
                  <p><input class=\"flip-input flip-padding-small flip-border\" type=\"password\" placeholder=\"Password\" required name=\"pwd\"></p>
                  <p><input class=\"flip-black flip-hover-green flip-padding-large\" style='text-align: center; width: 50%!important; margin-left: 25%' 
                                type=\"submit\" name=\"submit\" value='Sign In'></p>
            </form>
            <div class=\"flip-padding-small flip-margin-bottom flip-center\">
                <a class='flip-small flip-bar-item flip-hover-text-green flip-left flip-animate-right' href='Home.php' style='text-decoration: none !important'> Return to home page</a>
                <a class='flip-small flip-bar-item flip-hover-text-green flip-right flip-animate-left'  style='text-decoration: none !important'href='LeaderSignUp.php'> Sign Up</a>
            </div>
        </div>
      </div>
    ";
}