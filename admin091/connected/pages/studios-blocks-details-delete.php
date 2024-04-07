<?php
$id_studio = $_GET['id'];

$stmt = $db_client->prepare("SELECT id_studio FROM studios_blocks_details WHERE id=?");
$stmt->execute(array($_POST['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_studio = $row['id_studio'];

$stmt = $db_client->prepare("DELETE FROM studios_blocks_details WHERE id=:id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();

header("Location: studios-blocks-details-edit-" . $id_studio);
