<?php

include 'conn.php';

if (isset($_COOKIE['lang'])) {
    include 'diller/' . $_COOKIE['lang'] . '.php';
} else {
    setcookie("lang", "turkce");
    include 'diller/Turkce.php';
}

include 'fonksiyonlar/fonksiyonlar.php';
include 'sablonlar/header.php';

if (!isset($noSidebar)) {
    include 'sablonlar/sidebar.php';
}