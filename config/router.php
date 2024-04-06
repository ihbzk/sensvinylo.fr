<?php

$slug = str_replace(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
$base = 'https://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

include "routes.php";

if (strpos($slug, '/?') !== false) {
    $slug = strstr($slug, '/?', true);
} elseif (strpos($slug, '?') !== false) {
    $slug = strstr($slug, '?', true);
}

$current_route = array_search($slug, $routes);

if (!$current_route) {
    if (empty($slug)) {
        $current_route = "home";
    } elseif (strpos($slug, $routes['projects'] . '-') !== false) {
        $current_route = "projects";
    } elseif (strpos($slug, $routes['project-single'] . '-') !== false) {
        $current_route = "project-single";
        include "config/database.php";
        include "pages/project-single.php";
    } elseif (strpos($slug, $routes['studios'] . '-') !== false) {
        $current_route = "studios";
    } elseif (strpos($slug, $routes['studio-single'] . '-') !== false) {
        $current_route = "studio-single";
        include "config/database.php";
        include "pages/studio-single.php";
    } else {
        http_response_code(404);
        $current_route = "404";
    }
}

$page = "pages/" . $current_route . ".php";

if ($current_route == "studio-single" || $current_route == "project-single") {
    $conf_title = $meta_title;
    $conf_description = $meta_description;
    $conf_keywords = $meta_keywords;
} else {
    $conf_title = $metas[$current_route][0];
    $conf_description = $metas[$current_route][1];
    $conf_keywords = $metas[$current_route][2];
}