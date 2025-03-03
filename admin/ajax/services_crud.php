<?php
require("../inc/db_config.php");
require("../inc/uploadImage.php");
require("../inc/essentials.php");

if (isset($_POST["add_service"])) {
    $frm_data = filteration($_POST);

    $img_r = uploadSVGImage($_FILES['icon'], SERVICES_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == "upd_failed") {
        echo $img_r;
    } else {
        $q = "INSERT INTO `services`(`icon`, `name`, `description`) VALUES (?,?,?)";
        $values = [$img_r, $frm_data['name'], $frm_data['description']];
        $res = insert($q, $values, "sss");
        echo $res;
    }
}

if (isset($_POST["get_services"])) {
    $res = selectAll('services');
    $i = 1;
    $path = SERVICES_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr>
                <td> $i</td>   
                <td> $row[name]</td>   
                <td> <img src="$path$row[icon]" /></td>   
                <td> $row[description]</td>   
                <td>
                    <button class="btn" onclick="rem_service($row[id])">
                        Delete
                    </button>
                </td>   

            <tr>
        data;
        $i++;
    }
}

if (isset($_POST["rem_service"])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_service']];

    $check_q = select("SELECT * FROM `venue_services` WHERE `services_id`=?", $values, 'i');

    if (mysqli_num_rows($check_q) == 0) {
        $pre_q = "SELECT * FROM `services` WHERE `id` = ?";
        $res = select($pre_q, $values, "i");
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img["icon"], SERVICES_FOLDER)) {
            $q = "DELETE FROM `services` WHERE `id`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo "0";
        }
    } else {
        echo 'venue_added';
    }
}
