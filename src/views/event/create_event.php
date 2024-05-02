<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Veranstaltung erstellen</div>
<form class="centered" action="" method="post">

    <div class="labeled_input">
        <label for="name"> Name: </label>
        <input type="text" name="name" id="name">
    </div>
    <div class="labeled_input">
        <label for="date"> Datum: </label>
        <input type="date" name="date" id="date">
    </div>
    <div class="labeled_input">
        <label for="start_time"> Beginn: (Bei Angabe muss es auch ein Ende geben) </label>
        <input type="time" name="start_time" id="start_time">
    </div>
    <div class="labeled_input">
        <label for="end_time"> Ende: (Bei Angabe muss es auch einen Beginn geben)  </label>
        <input type="time" name="end_time" id="end_time">
    </div>

    <button type="submit" class="submit_button" name="create_event">
        Veranstaltung erstellen
    </button>
</form>