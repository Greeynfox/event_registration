<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Benutzer bearbeiten</div>
<form class="centered" action="<?= WEBROOT ?>index.php?action=edit&controller=user" method="post">
    <div class="labeled_input">
        <label for="first_name"> Vorname: </label>
        <input type="text" name="first_name" id="first_name" value="<?= $user->first_name ?>">
    </div>
    <div class="labeled_input">
        <label for="last_name"> Nachname: </label>
        <input type="text" name="last_name" id="last_name" value="<?= $user->last_name ?>">
    </div>
    <div class="labeled_input">
        <label for="user_role"> Benutzerrolle: </label>
        <select name="user_role" id="user_role">
            <option hidden selected>
                <?= $user->authorisation ?>>
            </option>
            <option>
                Administrator
            </option>
            <option>
                Veranstalter
            </option>
        </select>
    </div>
    <button disabled class="submit-button" name="save_registration">
        Änderungen speichern
    </button>
    <button class="delete-button" name="delete_registration">
        Anmeldung löschen
    </button>
</form>