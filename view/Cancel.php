<?php
/**
 * Project: ics499_project
 *
 * Cancel.php: Is used to cancel any registrations/signup the user chooses to.
 *              It will destroy temporary Sessions that have been created
 *              during the registration process.
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-28 16:06
 *
 * Last update by:
 * Last update on:
 */
session_start();

// To destroy any volleyball registration temporary session
if (isset($_SESSION['temp_roster_name'])) {

    unset($_SESSION['temp_roster_name']);
}

// Redirect to LeaderInterface.php if Leader is signed in
if (isset($_SESSION['username'])){
    header("Location: ../view/LeaderInterface.php");
    exit();
} else {
    // Redirect user to home page
    header("Location: ../view/Home.php");
    exit();
}