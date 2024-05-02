<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Anmeldeformular</div>
<form class="centered" action="<?= WEBROOT ?>index.php?action=create&controller=registration" method="post">
    <div class="labeled_input">
        <label for="event">Aktuelle Veranstaltungen: </label>
        <select class=""  name="event" id="event">
            <option selected>
                -- Keine Veranstaltung ausgewählt --
            </option>
        </select>
    </div>
    <div class="labeled_input">
        <label for="first_name"> Vorname: </label>
        <input type="text" name="first_name" id="first_name">

    </div>
    <div class="labeled_input">
        <label for="last_name"> Nachname: </label>
        <input type="text" name="last_name" id="last_name">

    </div>
    <button type="submit" class="submit_button" name="send_registration">
        Anmeldung abschicken
    </button>
</form>