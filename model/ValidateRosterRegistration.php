<?php
/**
 * Project: ics499_project
 *
 * ValidateRosterRegistration.php:
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-25 00:51
 *
 * Last update by:
 * Last update on:
 */
session_start();

include_once "../utilities/CleanData.php";
include_once "../controller/UserController.php";
include_once "CreateUniqueId.php";

// To register a Roster
if ($_POST["register"] === "signup") {
    // Instantiate CleanData class
    $cleanup_object = new CleanData();


    // Trim all incoming data
    $trimmed = array_map('trim', $_POST);

    // Create an error array
    $signupErrorArr = array();

    // Array to hold players
    $playerArray = array();

    // Clean up data
    // Players signup
//    for ($i = 1; $i <= 6; $i++) {
//        // First Name
//        $playerFname = "plr" . $i . "_fName";
//        if (!empty($trimmed[$playerFname])) {
//            $first_name = $cleanup_object->getVarClean($trimmed[$playerFname]);
//        } else {
//            $first_name = false;
//            $signupErrorArr[] = "First Name cannot be empty";
//        }
//        // Last Name
//        $playerLname = "plr" . $i . "_lName";
//        if (!empty($trimmed[$playerLname])) {
//            $last_name = $cleanup_object->getVarClean($trimmed[$playerLname]);
//        } else {
//            $last_name = false;
//            $signupErrorArr[] = "Last Name cannot be empty";
//        }
//        // phone
//        $playerFname = "plr" . $i . "_phone";
//        if (!empty($trimmed[$playerFname])) {
//            $phone = $cleanup_object->getVarClean($trimmed[$playerFname]);
//        } else {
//            $phone = false;
//            $signupErrorArr[] = "Phone cannot be empty";
//        }
//
//        // Populate player array
//        $playerArray[] = array('fname' => $first_name, 'lname' => $last_name, 'phone' => $phone);
//

//    } // End of array

    // Sport type
    if (!empty($trimmed['sport_type'])) {
        $sport = $cleanup_object->getVarClean($trimmed['sport_type']);
    } else {
        $sport = false;
        $signupErrorArr[] = "Sport Name cannot be empty";
    }

    // Sport type
    if (!empty($trimmed['total_players'])) {
        $total_players = $cleanup_object->getVarClean($trimmed['total_players']);
    } else {
        $total_players = false;
        $signupErrorArr[] = "Please enter number of players";
    }

    // If all fields are filled and username is unique register Leader
    if (empty($signupErrorArr)) {

        $controller = new UserController();

        // Roster Name
        $roster_name = $_SESSION['temp_roster_name'];

        // Leader name
        $name = $_SESSION['first_name'];

        // Leader id
        $leader_id = $_SESSION['leader_id'];

        echo "SESSION['leader_id']: " . $_SESSION['leader_id'] . " ";

        // Create a unique id for roster
        $createIdObj = new CreateUniqueId();
        $roster_id = $createIdObj->getUniqueId($roster_name, $name);

        // When registering, Leader has no team id. So it is empty
        $empty_leader_team_id = "";

        // Register Roster in temp table.
        $redirect = $controller->registerRoster($roster_id, $roster_name, $leader_id, $total_players, $sport, $playerArray);
        header("location: $redirect");

        exit();

    } else if (!empty($signupErrorArr)) {
        // Display errors
        foreach ($signupErrorArr as $error) {
            echo $error . "<br>";
        }
    }
} else {
    // Redirect the user to Roster Registration
    header("location: RosterRegistration.php");

    exit();
} // End of Roster Signup

