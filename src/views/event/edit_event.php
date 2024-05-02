<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Veranstaltung bearbeiten - <?= $event->name ?> </div>
<form class="centered" action="" method="post">
    <div class="labeled_input">
        <label for="name"> Name: </label>
        <input type="text" name="name" id="name" value="<?= $event->name ?>">
    </div>
    <div class="labeled_input">
        <label for="date"> Datum: </label>
        <input type="date" name="date" id="date" value="<?= $event->date ?>">
    </div>
    <div class="labeled_input">
        <label for="start_time"> Beginn: (Bei Angabe muss es auch ein Ende geben) </label>
        <input type="time" name="start_time" id="start_time" <?= $event->start ?>>
    </div>
    <div class="labeled_input">
        <label for="end_time"> Ende: (Bei Angabe muss es auch einen Beginn geben)  </label>
        <input type="time" name="end_time" id="end_time" <?= $event->end ?>>
    </div>
    <button type="submit" disabled class="submit_button" name="save_event">
        Änderungen speichern
    </button>
    <button type="submit" class="delete_button" name="delete_event">
        Anmeldung löschen
    </button>
</form>