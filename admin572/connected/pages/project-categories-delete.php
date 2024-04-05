<?php

$stmt=$db_client->prepare("DELETE FROM project_categories WHERE id=? ");
$stmt->execute(array($_POST['id']));

header("Location: project-categories");