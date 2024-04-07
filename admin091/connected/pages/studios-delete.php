<?php

if(!empty($_POST['cover_image'])) {
    $image = $_POST['cover_image'];
    unlink("../../" . $image);
}

if(!empty($_POST['fiche_technique'])) {
    $fiche_technique = $_POST['fiche_technique'];
    unlink("../../" . $fiche_technique);
}

$stmt=$db_client->prepare("DELETE FROM studios WHERE id=? ");
$stmt->execute(array($_POST['id']));

header("Location: studios");