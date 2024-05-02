<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Anmeldung bearbeiten - <?= $event->name ?> </div>
<div class="centered">
    <div class="labeled_input">
        <label for="first_name"> Vorname: </label>
        <input type="text" name="first_name" id="first_name" value="<?= $user->first_name ?>">
    </div>
    <div class="labeled_input">
        <label for="last_name"> Nachname: </label>
        <input type="text" name="last_name" id="last_name" value="<?= $user->last_name ?>">
    </div>
</div>
<form class="centered" action="<?= WEBROOT ?>index.php?action=edit&controller=registration" method="post">
    <button type="submit" disabled class="submit_button" name="save_registration">
        Änderungen speichern
    </button>
    <button type="submit" class="delete_button" name="delete_registration">
        Anmeldung löschen
    </button>
</form>