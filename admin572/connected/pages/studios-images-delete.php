<?php
$id_studio = $_GET['id'];

if (!empty($_POST['image']))
    unlink("../../" . $_POST['image']);

$stmt = $db_client->prepare("SELECT id_studio FROM studios_images WHERE id=?");
$stmt->execute(array($_POST['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_studio = $row['id_studio'];

$stmt = $db_client->prepare("DELETE FROM studios_images WHERE id=:id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();

header("Location: studios-images-edit-" . $id_studio);
