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

// To redirect user if input is incorrect
$volleyballRosterReg = "../view/VolleyballRosterRegistration.php";

// To register a Roster
if ($_POST["register"] === "signup") {
    // Instantiate CleanData class
    $cleanup_object = new CleanData();

    $sport = $_POST['sport_type'];
    $total_players = $_POST['total_players'];

    /* ********** Clean all the user input arrays ********** */
    // Player First Name
    $trimPlyrFnameArray = array_map('trim', $_POST['plyrFnameArray']);

    // Player Last Name
    $trimPlyrLnameArray = array_map('trim', $_POST['plyrLnameArray']);

    // Player Phone number
    $trimPlyrPhoneArray = array_map('trim', $_POST['plyrPhoneArray']);

    // Player T-shirt Number
    $trimPlyrShirtArray = array_map('trim', $_POST['plyrShirtArray']);

    // Player Position
    $trimPosition = array_map('trim', $_POST['positionArray']);

    /* ************************************************* */

    // Create an error array
    $signupErrorArr = array();

    // Array to hold players
    $playerArray = array();

    // Clean up every element of input arrays
    // Players signup
    for ($i = 0; $i < sizeof($trimPlyrFnameArray) ; $i++) {

        // Player First Name
        if (!empty($trimPlyrFnameArray[$i]) ) {
            $first_name = $cleanup_object->getVarClean($trimPlyrFnameArray[$i]);
        } else {
            $first_name = false;
            $signupErrorArr[] = "First Name cannot be empty";
        }

        // Player Last Name
        if (!empty($trimPlyrLnameArray[$i])) {
            $last_name = $cleanup_object->getVarClean($trimPlyrLnameArray[$i]);
        } else {
            $last_name = false;
            $signupErrorArr[] = "Last Name cannot be empty";
        }

        // Player phone
        $tempPhone = $trimPlyrPhoneArray[$i];
        if (!empty($tempPhone)){
            if (is_numeric($tempPhone)) {
                // it is a string because db takes it as a string
                $phone = (string) $cleanup_object->getVarClean($tempPhone);
            } else {
                $phone = false;
                $signupErrorArr[] = "Phone must be a number type";
            }
        } else {
            $phone = false;
            $signupErrorArr[] = "Phone cannot be empty";
        }

        // Player T-shirt number
        $tempShirt = $trimPlyrShirtArray[$i];
        if (!empty($tempShirt)){
            if (is_numeric($tempShirt)) {
                // it is a string because db takes it as a string
                $shirt = (int) $cleanup_object->getVarClean($tempShirt);
            } else {
                $shirt = false;
                $signupErrorArr[] = "Shirt must be a number type";
            }
        } else {
            $shirt = false;
            $signupErrorArr[] = "Phone cannot be empty";
        }

        // Player Position
        if (!empty($trimPosition[$i])) {
            $plyrPosition = $cleanup_object->getVarClean($trimPosition[$i]);
        } else {
            $plyrPosition = false;
            $signupErrorArr[] = "Player position cannot be empty";
        }

        // Populate player array
        if ($first_name and $last_name and $phone and $shirt and $plyrPosition) {
            $playerArray[$i] = array('fname' => $first_name, 'lname' => $last_name, 'phone' => $phone, 'shirt' => $shirt, 'position' => $plyrPosition);
        }

    } // End of array

    // Sport type
    if (!empty($sport)) {
        $sport = $cleanup_object->getVarClean($sport);
    } else {
        $sport = false;
        $signupErrorArr[] = "Sport Name cannot be empty";
    }

    // Total players
    if (!empty($total_players)) {
        $total_players = $cleanup_object->getVarClean($total_players);
    } else {
        $total_players = false;
        $signupErrorArr[] = "Please enter number of players";
    }


//    echo "Team name:" . $_SESSION['temp_roster_name'] . " Number of Players:" . $total_players . "<br>";
//    // Print array for testing only
//    foreach ($playerArray as $p => $item) {
//        echo "fname:" . $item['fname'] . "  lname:" . $item['lname'] . "  phone:" . $item['phone'] . "  shirt:" . $item['shirt'] . " position:" .  $item['position'] . "<br>";
//    }

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
        // Redirect the user to Roster Registration
        header("location: $volleyballRosterReg");
        exit();
    }
} else {
    // Redirect the user to Roster Registration
    header("location: $volleyballRosterReg");

    exit();
} // End of Roster Signup

