<?php
session_start();
$_SESSION['userid'] = 'iwan';
$_SESSION['role'] = 'admin';
$_SESSION['login_time'] = date('Y-m-d');
print_r($_SESSION);

/*
Output
Array
(
    [user] => agusph
    [role] => admin
    [login_time] => 2015-09-05
)
*/