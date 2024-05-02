<?php
session_start();
require_once "../../../config/web.php"
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Startseite</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= WEBROOT ?>src/views/layout/layout.css">
</head>
<body>
<header class="nav-header">
    <nav class="nav">
        <a class="title nav-home" href="<?= WEBROOT ?>src/views/registration/create_registration.php"> Anmeldung für Veranstaltungen</a>
        <a class="title nav-site" href="<?= WEBROOT ?>src/views/home/login.php">Veranstalter-Login</a>
    </nav>
    <img width="192" src="<?= WEBROOT ?>res/img/logo-bbw.svg" alt="Berufsbildungswerk ICP München">
</header>
<main>