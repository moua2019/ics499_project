<?php
/**
 * Project: ics499_project
 *
 * SignupConfirmation.php: Displays message
 *
 * Initial version by: Franklin Ortega.
 * Initial version on: 2019-03-19 16:45
 *
 * Last update by:
 * Last update on:
 */
$pageTitle = "SignIn";
include "Header.php";
include 'Logo.php';

echo "
    <div class=\"flip-content  flip-col l4 space-l-4 m6 space-m-3 flip-hide-small flip-card-4 flip-margin-top\" >
        <div class=\"flip-container flip-col l12 flip-bg-gradient-light-green\">
            <h2 class='flip-center flip-bold'>Signup Confirmation</h2>
        
            <h4 class='flip-center'>Your Registration was Successful!<br> Please Sign In</h4>
            <div class=\"flip-padding-small flip-margin-bottom flip-center\">
                 <a class='flip-black flip-hover-green flip-padding-large' style=' width: 50%!important; text-decoration: none !important' 
                                 href='SignIn.php' > Sign In</a>
            </div>
        </div>
    </div>
    <div class=\"flip-content  flip-col s10 space-s-1 flip-hide-large flip-hide-medium flip-card-4 flip-margin-top\" >
        <div class=\"flip-container flip-col l12 flip-bg-gradient-light-green\">
            <h2 class='flip-center'>Signup Confirmation</h2>
        
            <h4 class='flip-center'>Your Registration was Successful!<br> Please Sign In</h4>
            <div class=\"flip-padding-small flip-margin-bottom flip-center\">
                 <a class='flip-black flip-hover-green flip-padding-large' style=' width: 50%!important; text-decoration: none !important' 
                                 href='SignIn.php' > Sign In</a>
            </div>
        
        </div>
    </div>
    ";