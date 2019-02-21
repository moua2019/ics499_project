<?php
/**
 * Project: ics499_project
 *
 * Logout.php: Destroy every existing sessions and cookies. It will redirect user to
 *             home page.
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-20 13:57
 *
 * Last update by:
 * Last update on:
 */
session_start();

$page_title = 'Logout';
$home_page = "Home.php";

// If user is logged in
if (isset($_SESSION ['user'])){
    $_SESSION = array(); // Destroy the variables.
    session_destroy(); // Destroy session itself.
    setcookie(session_name(), '', time()-3600); // Destroy the cookie.

    // Redirect to elTrebol_home.php
    header("Location:" . $home_page);
    exit();
} else {
    echo "is not redirecting";
}
