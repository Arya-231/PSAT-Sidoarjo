<?php
session_start();

if (!isset($_SESSION['admin_login'])) {
    header("Location: index.php");
    exit;
}
