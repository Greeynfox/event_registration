<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Veranstaltung bearbeiten - <?= $event->getName() ?> </div>
<form class="centered" action="<?= WEBROOT ?>index.php?action=edit&controller=event&id=<?= $event->getId() ?>" method="post">
    <input hidden="" name="event_id" value="<?= $event->getId() ?>">
    <input hidden="" name="event_id" value="<?= $event->getId() ?>">
    <div class="labeled_input">
        <label for="name"> Name: </label>
        <input type="text" name="name" id="name" value="<?= $event->getName() ?>">
    </div>
    <div class="labeled_input">
        <label for="date"> Datum: </label>
        <input type="date" name="date" id="date" value="<?= $event->getDate() ?>">
    </div>
    <div class="labeled_input">
        <label for="start_time"> Beginn: (Bei Angabe muss es auch ein Ende geben) </label>
        <input type="time" name="start_time" id="start_time" <?= $event->getStartTime() ?>>
    </div>
    <div class="labeled_input">
        <label for="end_time"> Ende: (Bei Angabe muss es auch einen Beginn geben) </label>
        <input type="time" name="end_time" id="end_time" <?= $event->getEndTime() ?>>
    </div>
    <div class="subtitle centered"> Zusätzliche Attribute</div>
    <div class="attribute-grid" id="attribute_area">
        <?php foreach ($event_attributes as $event_attribute) {
            ?>
            <div class="grid-element element_row">
                <input hidden="" name="attribute_id[]" value="<?= $event_attribute->getId() ?>">
                <div class="labeled_input">
                    <label for="attribute_name"> Attributsname: </label>
                    <input type="text" value="<?= $event_attribute->getName() ?>" name="attributes[]"
                           id="attribute_name">
                </div>
                <div class="labeled_input">
                    <label for="attribute_type"> Attributstyp: </label>
                    <select name="attribute_types[]" id="attribute_type">
                        <option selected hidden><?= $event_attribute->getType() ?> </option>
                        <option>Anzahl</option>
                        <option>Checkbox</option>
                    </select>
                </div>
                    <button type="button" class="grid-delete-button" id="remove_attribute">
                       Löschen
                    </button>
            </div>
        <?php } ?>
    </div>
    <div class="element_row">
        <button type="button" class="submit-button" id="add_attribute">
            Attribut Hinzufügen
        </button>

    </div>

    <div class="element_row">
        <button type="submit"  class="submit-button" name="save_event">
            Änderungen speichern
        </button>
        <button type="submit" class="delete-button" name="delete_event">
            Event löschen
        </button>
    </div>
</form>
<template>
    <div class="grid-element element_row">
        <input hidden="" name="attribute_id[]" value="0">
        <div class="labeled_input">
            <label for="attribute_name"> Attributsname: </label>
            <input type="text" name="attributes[]" id="attribute_name">
        </div>
        <div class="labeled_input">
            <label for="attribute_type"> Attributstyp: </label>
            <select name="attribute_types[]" id="attribute_type">
                <option>Anzahl</option>
                <option>Checkbox</option>
            </select>
        </div>
        <button type="button" class="grid-delete-button" id="remove_attribute">
            Löschen
        </button>
    </div>
</template>
<script>
    //window.addEventListener("beforeunload", (e) => {
    //    e.preventDefault();
    //});
    let attribute_area = document.getElementById("attribute_area");

    let remove_attribute = document.getElementsByClassName("grid-delete-button");
    for (let i = 0; i < remove_attribute.length; i++) {
        remove_attribute[i].addEventListener("click", (e) => {
            e.target.parentNode.remove();
        });
    }

    let add_attribute = document.getElementById("add_attribute");
    add_attribute.addEventListener("click", () => {
        let template = document.getElementsByTagName("template")[0].content;
        let clone = template.cloneNode(true);
        attribute_area.appendChild(clone);
        attribute_area.lastElementChild.getElementsByClassName("grid-delete-button")[0].addEventListener("click", (e) => {
            e.target.parentNode.remove();
        });
    });
</script>