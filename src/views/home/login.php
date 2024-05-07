<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Anmelden</div>
<form class="centered" action="<?= WEBROOT ?>controllers/LoginController.php" method="post">
    <!-- <div class="labeled_input">
        <label for="first_name"> Vorname: </label>
        <input type="text" name="first_name" id="first_name">
    </div>
    <div class="labeled_input">
        <label for="last_name"> Nachname: </label>
        <input type="text" name="last_name" id="last_name">
    </div> -->
    <div class="labeled_input">
        <label for="username"> Benutzername: </label>
        <input type="text" name="username" id="username">
    </div>
    <div class="labeled_input">
        <label for="password"> Passwort: </label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit" class="submit-button" name="login">
        Anmelden
    </button>
</form>