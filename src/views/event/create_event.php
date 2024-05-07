<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Veranstaltung erstellen</div>
<form class="centered" action="<?= WEBROOT ?>index.php?action=create&controller=event" method="post">

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
        <label for="end_time"> Ende: (Bei Angabe muss es auch einen Beginn geben) </label>
        <input type="time" name="end_time" id="end_time">
    </div>

    <div class="attribute-grid" id="attribute_area">


    </div>
    <div class="element_row">
        <button type="button" class="submit-button" id="add_attribute">
            Attribut Hinzufügen
        </button>
        <button type="button" class="delete-button" id="remove_attribute">
            Attribut entfernen
        </button>
    </div>
    <button type="submit" class="submit-button" name="create_event">
        Veranstaltung erstellen
    </button>
</form>
<template>
    <div class="grid-element element_row">
        <div class="labeled_input">
            <label for="attribute_name"> Attributsname: </label>
            <input type="text" name="attributes[]" id="attribute_name">
        </div>
        <div class="labeled_input">
            <label for="attribute_type"> Attributstyp: </label>
            <select name="attribute_types[]" id="attribute_type">
                <option value="1">Anzahl</option>
                <option value="2">Checkbox</option>
            </select>
        </div>
    </div>
</template>
<script>
    const add_attributes = document.getElementById("add_attribute");
    const remove_attributes = document.getElementById("remove_attribute");

    const attribute_area = document.getElementById("attribute_area");

    add_attributes.addEventListener("click", () => {
        let template = document.getElementsByTagName("template")[0].content;
        let clone = template.cloneNode(true);
        attribute_area.appendChild(clone);
    });

    remove_attributes.addEventListener("click", () => {
        let attributes = attribute_area.getElementsByClassName("grid-element");
        if(attributes.length > 0) {
            attributes[attributes.length - 1].remove();
        }
    });
</script>