<?php
session_start();

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // isi jika ada password
$DB_NAME = 'bioskop';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

function is_logged_in() {
    return isset($_SESSION['id_user']);
}

function current_user_name() {
    return $_SESSION['username'] ?? '';
}
?>
