<?php

function move_image($input)
{
    $res = array();
    $extension = array("jpg", "png");
    $dossier = "img/news/";
    $file_name = $input['file']["image"]["name"];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    if ($ext == 'jpeg') {
        $ext = 'jpg';
    }

    $file_name = md5(uniqid()) . "." . $ext;

    if (in_array($ext, $extension)) {
        $imageTemp = $dossier . $file_name;

        if (!file_exists($imageTemp)) {
            if (move_uploaded_file($input['file']['image']['tmp_name'], "../../" . $imageTemp)) {
                $image = $imageTemp;
            } else {
                $res['error'] = "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur lors du transfert de l'image, la taille ne doit pas être supérieur à 2Mo.</div>";
            }
        } else {
            $res['error'] = "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Erreur doublon.</div>";
        }
    } else {
        $res['error'] = "<div class='alert alert-danger'><button type='button' class='close' data-bs-dismiss='alert'>&times;</button>Veuillez choisir une image avec l'exention jpg ou png</div>";
    }
    
    $res['image'] = $image;

    return $res;
}