<?php
$id_project = $_GET['id'];

$stmt = $db_client->prepare("SELECT id_project FROM project_images WHERE id=?");
$stmt->execute(array($_POST['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$id_project = $row['id_project'];

$stmt = $db_client->prepare("DELETE FROM project_images WHERE id=:id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->execute();

header("Location: projects-videos-edit-" . $id_project);
