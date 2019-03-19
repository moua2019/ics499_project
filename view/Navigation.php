<?php
/**
 * Project: ics499_project
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-02-20 13:41
 *
 * Last update by:
 * Last update on:
 */

/*
 * To display options.
 * If Admin or Team Leader is logged in navigation will display Log Out option,
 * otherwise it will display Sign Up.
 */
if (isset($_SESSION['username'])){
    $user = $_SESSION['username'];
    $fname = $_SESSION['first_name'];
    $user_type = $_SESSION['user_type'];
    $SignUp_LogOut = "[$fname] Log Out";
    $SignUp_LogOut_URL = "Logout.php";

    // Admin Navigation
    if ($user_type == "admin"){
        echo "
            <!-- Navbar -->
            <div class=\"flip-top\">
                <div class=\"flip-bar flip-blue-499 flip-card flip-left-align flip-large\">
                    <a class=\" flip-button flip-hide-medium flip-hide-large flip-right flip-padding-large flip-hover-white flip-large flip-red\" href=\"javascript:void(0);\" onclick=\"myFunction()\" title=\"Toggle Navigation Menu\"><i class=\"fa fa-bars\"></i></a>
                    <a href=\"#\" class=\"flip-bar-item flip-button flip-white\"><i class=\"fa fa-home\" style=\"font-size: 26px; padding: 5px 24px\" ></i></a>
                    <a href=\"$SignUp_LogOut_URL\" class=\"flip-bar-item flip-button flip-hide-small flip-padding-large flip-hover-white flip-medium flip-right\">$SignUp_LogOut</a>
                </div>
    
                <!-- Navbar on small screens -->
                <div id=\"navDemo\" class=\"flip-bar-block flip-white flip-hide flip-hide-large flip-hide-medium flip-large\">
                    <a href=\"#\" class=\"flip-bar-item flip-button flip-padding-large\">Schedule</a>
                    <a href=\"$SignUp_LogOut_URL\" class=\"flip - bar - item flip - button flip - hide - small flip - padding - large flip - hover - white flip - medium flip - right\">$SignUp_LogOut</a>
                </div>
            </div>
        ";
    } else if ($user_type == "leader") {
        $leader_team = isset($_SESSION['leader_has_Team']) ? "Team" : "Team SignUp";

        echo "
            <!-- Navbar -->
            <div class=\"flip-top\">
                <div class=\"flip-bar flip-blue-499 flip-card flip-left-align flip-large\">
                    <a class=\" flip-button flip-hide-medium flip-hide-large flip-right flip-padding-large flip-hover-white flip-large flip-red\" href=\"javascript:void(0);\" onclick=\"myFunction()\" title=\"Toggle Navigation Menu\"><i class=\"fa fa-bars\"></i></a>
                    <button class=\"tablink flip-bar-item flip-button flip-hide-small flip-padding-large flip-hover-white\" id=\"defaultOpen\" onclick=\"openDescription('Profile', this, 'white')\"><i class=\"fa fa-user \" ></i></button>
                    <button class=\"tablink flip-bar-item flip-button flip-hide-small flip-padding-large flip-hover-white\" onclick=\"openDescription('Schedule', this, 'white')\">Schedule</button>
                    <button class=\"tablink flip-bar-item flip-button flip-hide-small flip-padding-large flip-hover-white\" onclick=\"openDescription('Events', this, 'white')\">Games</button>
                    <button class=\"tablink flip-bar-item flip-button flip-hide-small flip-padding-large flip-hover-white\" onclick=\"openDescription('Team', this, 'white')\">$leader_team</button>
                    <a href=\"$SignUp_LogOut_URL\" class=\"flip-bar-item flip-button flip-hide-small flip-padding-arge flip-hover-white flip-medium flip-right\">$SignUp_LogOut</a>
                </div>
    
                <!-- Navbar on small screens -->
                <div id=\"navDemo\" class=\"flip-bar-block flip-white flip-hide flip-hide-large flip-hide-medium flip-large\">
                    <a href=\"#\" class=\"flip-bar-item flip-button flip-padding-large\">Schedule</a>
                    <a href=\"$SignUp_LogOut_URL\" class=\"flip - bar - item flip - button flip - hide - small flip - padding - large flip - hover - white flip - medium flip - right\">$SignUp_LogOut</a>
                </div>
            </div>
        ";
    }


} else { // Leader Navigation
    $SignUp_LogOut = "Sign Up";
    $SignUp_LogOut_URL = "LeaderSignUp.php";
    echo "  
        <!-- Navbar -->
        <div class=\"flip-top\">
            <div class=\"flip-bar flip-blue-499 flip-card flip-left-align flip-large\">
                <a class=\" flip-button flip-hide-medium flip-hide-large flip-right flip-padding-large flip-hover-white flip-large flip-red\" href=\"javascript:void(0);\" onclick=\"myFunction()\" title=\"Toggle Navigation Menu\"><i class=\"fa fa-bars\"></i></a>
                <a href=\"#\" class=\"flip-bar-item flip-button flip-white\"><i class=\"fa fa-home\" style=\"font-size: 26px; padding: 5px 24px\" ></i></a>
                <a href=\"$SignUp_LogOut_URL\" class=\"flip-bar-item flip-button flip-hide-small flip-padding-large flip-hover-white flip-medium flip-right\">$SignUp_LogOut</a>
            </div>
        
            <!-- Navbar on small screens -->
            <div id=\"navDemo\" class=\"flip-bar-block flip-white flip-hide flip-hide-large flip-hide-medium flip-large\">
                <a href=\"#\" class=\"flip-bar-item flip-button flip-padding-large\">Schedule</a>
                <a href=\"$SignUp_LogOut_URL\" class=\"flip - bar - item flip - button flip - hide - small flip - padding - large flip - hover - white flip - medium flip - right\">$SignUp_LogOut</a>
            </div>
        </div>
        
    ";

}
