<?php
session_start(); // Start session once the page is loaded 
require_once "backend/includes/verify.inc.php";
$loggedin = verify_session();
if (isset($_GET['filename'])){
    $filename = $_GET['filename']; 
}
else{
    $filename = "";
}
switch ($filename) {
    case 'signup':
        include('templates/Login Pages/signup.tpl.php');  
    break;
    case 'login':
        include('templates/Login Pages/login.tpl.php');
    break;
    case 'teamsignup':
        include('templates/Login Pages/team_choice.tpl.php');  
    break;
    case 'teamcreation':
        include('templates/Login Pages/create_team.tpl.php');  
    break;
    case 'teamjoin':
        include('templates/Login Pages/join_team.tpl.php');  
    break;
    case 'teamexists':
        include('templates/Login Pages/create_team_msg.tpl.php');  
    break;
    case 'teamdosentexist':
        include('templates/Login Pages/join_team_msg.tpl.php');  
    break;
    default:
        if ($filename == 'leaderboard' && $loggedin && isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            include('backend/leaderboard.php');
            include('templates/User Pages/leaderboard.tpl.php');  
        }
        else if ($filename == 'resources' && $loggedin) {
            include('templates/User Pages/resources_page.tpl.php');  
        }
        else if ($filename == ''||$filename=="home"||$filename=="challenge" && $loggedin) {
            include('backend/challenge.php');
            include('templates/User Pages/challenge_page.tpl.php');
        }
        else{
            include('templates/Login Pages/login.tpl.php');
        }
    break;
}
// Rdev footer
include('templates/footer.tpl.php');
?>