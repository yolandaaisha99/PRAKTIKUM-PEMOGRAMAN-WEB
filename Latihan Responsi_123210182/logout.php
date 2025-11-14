<?php
require 'koneksi.php';
session_unset();
session_destroy();
session_start();
$_SESSION['logout_msg'] = 'Anda telah logout.';
header('Location: login.php');
exit;
