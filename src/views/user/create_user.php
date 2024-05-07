<?php
include "../../../src/views/layout/header.php";
?>
<div class="title centered"> Benutzer erstellen</div>
<form class="centered" action="<?= WEBROOT ?>index.php?action=create&controller=user" method="post">
    <div class="labeled_input">
        <label for="first_name"> Vorname: </label>
        <input type="text" name="first_name" id="first_name">
    </div>
    <div class="labeled_input">
        <label for="last_name"> Nachname: </label>
        <input type="text" name="last_name" id="last_name">
    </div>
    <div class="labeled_input">
        <label for="user_role"> Benutzerrolle: </label>
        <select name="user_role" id="user_role">
            <option selected>
                -- Keine Berechtigung ausgewählt --
            </option>
            <option>
                Administrator
            </option>
            <option>
                Veranstalter
            </option>
        </select>
    </div>
    <button class="submit-button" name="create_user">
        Benutzer erstellen
    </button>
</form>