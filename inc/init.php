<?php
include 'config.php';

$link = mysqli_connect("localhost", "root", "", "med_system");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit();
}

include 'functions.php';

$logged_in = false;
if (isset($_COOKIE['user']) && isset($_COOKIE['parola'])) {
    $udata = get_user($_COOKIE['user'], $_COOKIE['parola']);
    if (isset($udata['id'])) {
        $logged_in = true;
    }
}

if (isset($_GET['logout'])) {
    setcookie("user", '', time() - COOKIE_EXPIRE_TIME);
    setcookie("parola", '', time() - COOKIE_EXPIRE_TIME);
    header('location: login.php?logout_success');
    die();
}
