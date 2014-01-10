<?php

/*
*   author : Eray ARSLAN
*   web    : erayarslan.com
*/

require_once("Team.php");
require_once("Utils.php");

$myTeam = new Team();

include_once("SteamSignIn.php");
$steam_login_verify = SteamSignIn::validate();
if(!empty($steam_login_verify)) {
    if($steam_login_verify==convertAccountIdToSteamId64($myTeam->getCaptain())) {
        echo "You're Captain!";
    } else {
        echo "You're Player!";
    }
} else {
    $steam_sign_in_url = SteamSignIn::genUrl();
    echo "<a href=\"$steam_sign_in_url\"><img src='http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_large_noborder.png' /></a>";
}