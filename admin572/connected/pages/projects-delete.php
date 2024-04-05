<?php

$id = $_POST['id'];
$stmt = $db_client->prepare("DELETE FROM project WHERE id=?");
$stmt->execute(array($id));

header("Location: project");