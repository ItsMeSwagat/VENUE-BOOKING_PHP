<?php

define("SITE_URL", "http://127.0.0.1/venueBooking/");
define("SERVICES_IMG_PATH", SITE_URL . "images/services/");
define("VENUES_IMG_PATH", SITE_URL . "images/venues/");

define("UPLOAD_IMAGE_PATH", $_SERVER['DOCUMENT_ROOT'] . '/venueBooking/images/');
define('SERVICES_FOLDER', 'services/');
define('VENUES_FOLDER', 'venues/');



function uploadImage($image, $folder)
{
    $valid_mine = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img';
    } else if (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";

        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }
}

function uploadSVGImage($image, $folder)
{
    $valid_mine = ['image/svg+xml'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img';
    } else if (($image['size'] / (1024 * 1024)) > 1) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";

        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }
}

function deleteImage($image, $folder)
{

    if (unlink(UPLOAD_IMAGE_PATH . $folder . $image)) {
        return true;
    } else {
        return false;
    }
}
