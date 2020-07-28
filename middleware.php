<?php
session_start();

$is_login_page = ($_SERVER['SCRIPT_FILENAME'] === __DIR__ . '/public/index.php');

if (empty($_SESSION['username']) && $is_login_page == false) {
    header('Location: index.php');
    die();
}

if (!empty($_SESSION['username']) && $is_login_page) {
    header('Location: dashboard.php');
    die();
}
