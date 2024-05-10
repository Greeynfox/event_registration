<?php
include "src/views/layout/header.php";
?>
<div class="title centered"> Anmeldeformular</div>
<form id="event_selection" class="centered" action="<?= WEBROOT ?>index.php?action=show&controller=registration" method="get">
    <div class="labeled_input">
        <label for="event">Aktuelle Veranstaltungen: </label>
        <select class="" name="selected_event" id="event">
            <option  value="0"> -- Keine Veranstaltung ausgewählt --  </option>
                <?php foreach ($events as $event) { ?>
                <option <?php if(!empty($_GET["selected_event"]) && $_GET["selected_event"] == $event["id"]) echo "selected" ?> value="<?= $event["id"] ?>"><?= $event["name"] ?> </option>
                <?php } ?>
        </select>
    </div>
    </form>
<form class="centered" action="<?= WEBROOT ?>index.php?action=create&controller=registration" method="post">
    <?php if(!empty($_GET["selected_event"])) { ?>
        <input type="hidden" name="event_id" value="<?= $_GET["selected_event"] ?>">
    <?php } ?>
    <div class="labeled_input">
        <label for="first_name"> Vorname: </label>
        <input type="text" name="first_name" id="first_name">
    </div>
    <div class="labeled_input">
        <label for="last_name"> Nachname: </label>
        <input type="text" name="last_name" id="last_name">
    </div>
    <div class="attribute-grid" id="attribute_area">
    <?php foreach ($event_attributes as $event_attribute) { ?>
        <div class="attribute-grid-element">
            <input type="hidden" name="attribute_ids[]" value="<?= $event_attribute->getId() ?>">
            <div class="small-grid-element element_row">
                <label class="small-grid-element" for="attribute_type"> <?= $event_attribute->getName() ?>:</label>
                <?php if ($event_attribute->getType() == A_TYPE_NUMBER) { ?>
                    <input class="" name ="" id="attribute_type" type="number" min="0" value="0">
                <?php } else if ($event_attribute->getType() == A_TYPE_CHECKBOX) { ?>
                    <input class="small-grid-element" name="" id="attribute_type" type="checkbox">
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    </div>
    <button type="submit" class="submit-button" name="send_registration">
        Anmeldung abschicken
    </button>
</form>
<script>
    document.getElementById("event").addEventListener("change", () => {
        document.getElementById("event_selection").submit();
    })
</script>