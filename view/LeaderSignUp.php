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
include "../utilities/Header.php";
include "../utilities/Logo.php";

echo "
<div class=\"flip-content flip-container flip-centered flip-col l4 space-l-4 m6 space-m-3 flip-card-4 flip-margin-bottom\" >
    <div class=\"flip-container flip-col l12 \">
        <h2 class='flip-center'>Sign Up</h2>
        <form action='LeaderSignUp.php' method='post' >
              <p><input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"First Name\" required name=\"fName\"></p>
              <p><input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"Last Name\" required name=\"lName\"></p>
              <p><input class=\"flip-input flip-padding-small flip-border\" type=\"text\" placeholder=\"user Name\" required name=\"userName\"></p>
              <p><input class=\"flip-input flip-padding-small flip-border\" type=\"password\" placeholder=\"Password\" required name=\"pwd\"></p>
              <p><input class=\"flip-input flip-padding-small flip-border\" type=\"email\" placeholder=\"Email\" required name=\"email\"></p>
              <p><input class=\"flip-input flip-padding-small flip-border\" type=\"tel\" maxlength=\"10\" placeholder=\"Phone\" required name=\"Email\"></p>
              <p><button class=\"flip-hover-green flip-black flip-padding\" style='text-align: center; max-width: 60%!important; margin-left: 30%' type=\"submit\">SIGN UP</button></p>
        </form>
        <div class=\"flip-padding-small flip-margin-bottom \">
            <a class='flip-small flip-bar-item flip-hover-text-green flip-left flip-animate-right' href='Home.php' style='text-decoration: none !important'> Return to home page</a>
            <a class='flip-small flip-bar-item flip-hover-text-green flip-right flip-animate-left'  style='text-decoration: none !important'href='SignIn.php'> Sign In</a>
        </div>
    </div>
</div>

<div>
<p></p>
</div>
</body>
</html>
";
