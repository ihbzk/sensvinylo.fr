<?php

$slug = str_replace(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
$base = 'https://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

$page = "pages/";

//echo $_SERVER['REQUEST_URI']." => ".$slug;die;

switch ($slug) {
	// Show main pages
	case '':
		$page .= "index";
		$title = "Accueil";
		break;
	case 'accueil':
		$page .= "home";
		$title = "Accueil";
		break;
	case 'choose-template':
		$page .= "choose-template";
		$title = "Choisir un template";
		break;
	case 'project':
		$page .= "project";
		$title = "Projets";
		break;
	case 'studios':
		$page .= "studios";
		$title = "Studios";
		break;
	case 'project-categories':
		$page .= "project-categories";
		$title = "Catégories de projet";
		break;
	default:
		// Show edit pages

		// Studios
		if (strpos($slug, "studios-edit") !== false) {
			$page .= "studios-edit";
			$title = "Edition du studio";
		}
		// Projects Categories
		elseif (strpos($slug, "project-categories-edit") !== false) {
			$page .= "project-categories-edit";
			$title = "Edition de la catégorie pour les projets";
		}
		// Projects
		elseif (strpos($slug, "projects-edit") !== false) {
			$page .= "projects-edit";
			$title = "Edition du projet";
		}
		// Projects Images
		elseif (strpos($slug, "projects-images-edit") !== false) {
			$page .= "projects-images-edit";
			$title = "Edition des images du projet";
		}
		// Projects Videos
		elseif (strpos($slug, "projects-videos-edit") !== false) {
			$page .= "projects-videos-edit";
			$title = "Edition des vidéos du projet";
		}
		// Projects Single Image
		elseif (strpos($slug, "projects-single-image-edit") !== false) {
			$page .= "projects-single-image-edit";
			$title = "Edition de l'image du projet";
		}
		// Projects Single Video
		elseif (strpos($slug, "projects-single-video-edit") !== false) {
			$page .= "projects-single-video-edit";
			$title = "Edition de la vidéo du projet";
		}
		// Studios Images
		elseif (strpos($slug, "studios-images-edit") !== false) {
			$page .= "studios-images-edit";
			$title = "Edition des images du studio";
		}
		// Studios Single Image
		elseif (strpos($slug, "studios-single-image-edit") !== false) {
			$page .= "studios-single-image-edit";
			$title = "Edition de l'image du studio";
		}
		// Studios Blocks Details
		elseif (strpos($slug, "studios-blocks-details-edit") !== false) {
			$page .= "studios-blocks-details-edit";
			$title = "Edition des blocks détails du studio";
		}
		// Studios Single Block Details
		elseif (strpos($slug, "studios-blocks-details-single-edit") !== false) {
			$page .= "studios-blocks-details-single-edit";
			$title = "Edition du block détails du studio";

		// Show add pages
		} elseif (strpos($slug, "studios-add") !== false) {
			$page .= "studios-add";
			$title = "Ajout d'un studio";
		} elseif (strpos($slug, "studios-images-add") !== false) {
			$page .= "studios-images-add";
			$title = "Ajout des images du studio";
		} elseif (strpos($slug, "studios-blocks-details-add") !== false) {
			$page .= "studios-blocks-details-add";
			$title = "Ajout d'un bloc détails du studio";
		} elseif (strpos($slug, "project-categories-add") !== false) {
			$page .= "project-categories-add";
			$title = "Ajout d'une catégorie pour les projets";
		} elseif (strpos($slug, "project-blocks1-add") !== false) {
			$page .= "project-blocks1-add";
			$title = "Ajout d'un projet";
		} elseif (strpos($slug, "projects-images-add") !== false) {
			$page .= "projects-images-add";
			$title = "Ajout des images d'un projet";
		} elseif (strpos($slug, "projects-videos-add") !== false) {
			$page .= "projects-videos-add";
			$title = "Ajout des vidéos d'un projet";
		} elseif (strpos($slug, "project-blocks2-add") !== false) {
			$page .= "project-blocks2-add";
			$title = "Ajout d'un projet";

		// Show delete pages
		} elseif (strpos($slug, "studios-images-delete") !== false) {
			$page .= "studios-images-delete";
			$title = "Suppression des images du studio";
		} elseif (strpos($slug, "studios-blocks-details-delete") !== false) {
			$page .= "studios-blocks-details-delete";
			$title = "Suppression des blocs détails du studio";
		} elseif (strpos($slug, "studios-delete") !== false) {
			$page .= "studios-delete";
			$title = "Suppression du studio";
		} elseif (strpos($slug, "project-categories-delete") !== false) {
			$page .= "project-categories-delete";
			$title = "Suppression de la catégorie pour les projets";
		} elseif (strpos($slug, "projects-delete") !== false) {
			$page .= "projects-delete";
			$title = "Suppression du projet";
		} elseif (strpos($slug, "projects-images-delete") !== false) {
			$page .= "projects-images-delete";
			$title = "Suppression des images du projet";
		} elseif (strpos($slug, "projects-videos-delete") !== false) {
			$page .= "projects-videos-delete";
			$title = "Suppression des vidéos du projet";
			
		// Show visibility pages
		} elseif (strpos($slug, "project-categories-visible") !== false) {
			$page .= "project-categories-visible";
			$title = "Visibilité de la catégorie";
		} elseif (strpos($slug, "studios-visible") !== false) {
			$page .= "studios-visible";
			$title = "Visibilité du studio";
		} elseif (strpos($slug, "project-blocks1-visible") !== false) {
			$page .= "project-blocks1-visible";
			$title = "Visibilité du projet";
		} elseif (strpos($slug, "project-blocks2-visible") !== false) {
			$page .= "project-blocks2-visible";
			$title = "Visibilité du projet";

		// Show main pages	
		} elseif (strpos($slug, "choose-template-project") !== false) {
			$page .= "choose-template-project";
			$title = "Choisir un template";
		} else
			header("Location: 404");
}
$page .= ".php";
