<?php
require("../inc/db_config.php");
require("../inc/uploadImage.php");
require("../inc/essentials.php");

if (isset($_POST["add_venue"])) {
    $features = filteration(json_decode($_POST["features"], true));
    $services = filteration(json_decode($_POST["services"], true));
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "INSERT INTO `venues`(`name`, `price`, `quantity`, `area`, `capacity`, `description`) VALUES (?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['price'], $frm_data['quantity'], $frm_data['area'], $frm_data['capacity'], $frm_data['description']];

    if (insert($q1, $values, "siiiis")) {
        $flag = 1;
    };

    $venue_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `venue_features`(`venue_id`, `features_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, "ii", $venue_id, $f);
            mysqli_stmt_execute($stmt);
        };
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die("Query cannot be prepared - Insert");
    };

    $q3 = "INSERT INTO `venue_services`(`venue_id`, `services_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($services as $s) {
            mysqli_stmt_bind_param($stmt, "ii", $venue_id, $s);
            mysqli_stmt_execute($stmt);
        };
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die("Query cannot be prepared - Insert");
    };

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    };
}

if (isset($_POST["get_all_venues"])) {
    $res = selectAll('venues');
    $i = 1;

    $data = "";


    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['status'] == 1) {
            $status = "<button onclick='toggle_status($row[id],0)' class='edit-btn'>active</button>";
        } else {
            $status = "<button onclick='toggle_status($row[id],1)' class='delete-btn'>inactive</button>";
        };

        $data .= "
                <tr>
                    <td> $i</td>   
                    <td> $row[name]</td>   
                    <td> $row[area] sq.ft</td>   
                    <td> $row[capacity]</td>   
                    <td> Rs$row[price]</td>   
                    <td> $row[quantity]</td>   
                    <td> $status</td>   
                    <td>
                        <button class='edit-btn'>
                            <a href='edit_venue.php?id=$row[id]'>Edit</a>
                        </button>
                        <button class='edit-btn'>
                            <a href=\"add_venueImage.php?id=$row[id]&name=$row[name]\">Add Img</a>
                        </button>
                        <button class='delete-btn' onclick='rem_service($row[id])'>
                            Delete
                        </button>
                    </td>   
                <tr>
        ";
        $i++;
    }
    echo $data;
}

if (isset($_POST["get_venue"])) {
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `venues` WHERE `id`=?", [$frm_data['get_venue']], 'i');
    $res2 = select("SELECT * FROM `venue_features` WHERE `venue_id`=?", [$frm_data['get_venue']], 'i');
    $res3 = select("SELECT * FROM `venue_services` WHERE `venue_id`=?", [$frm_data['get_venue']], 'i');


    $venuedata = mysqli_fetch_assoc($res1);
    $features = [];
    $services = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['features_id']);
        }
    }

    if (mysqli_num_rows($res3) > 0) {
        while ($row = mysqli_fetch_assoc($res3)) {
            array_push($services, $row['services_id']);
        }
    }

    $data = ["venuedata" => $venuedata, "features" => $features, "services" => $services];

    $data = json_encode($data);

    echo $data;
}

if (isset($_POST["edit_venue"])) {
    $features = filteration(json_decode($_POST["features"], true));
    $services = filteration(json_decode($_POST["services"], true));
    $frm_data = filteration($_POST);
    $flag = 0;

    $q1 = "UPDATE `venues` SET `name`=?,`price`=?,`quantity`=?,`area`=?,`capacity`=?,`description`=? WHERE `id` = ?";
    $values = [$frm_data['name'], $frm_data['price'], $frm_data['quantity'], $frm_data['area'], $frm_data['capacity'], $frm_data['description'], $frm_data['venue_id']];

    if (update($q1, $values, "siiiisi")) {
        $flag = 1;
    }

    $del_features = delete("DELETE FROM `venue_features` WHERE `venue_id`=?", [$frm_data['venue_id']], "i");
    $del_services = delete("DELETE FROM `venue_services` WHERE `venue_id`=?", [$frm_data['venue_id']], "i");


    if (!($del_features && $del_services)) {
        $flag = 0;
    }

    $q2 = "INSERT INTO `venue_features`(`venue_id`, `features_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, "ii", $frm_data['venue_id'], $f);
            mysqli_stmt_execute($stmt);
        };
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die("Query cannot be prepared - Insert");
    };

    $q3 = "INSERT INTO `venue_services`(`venue_id`, `services_id`) VALUES (?,?)";

    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($services as $s) {
            mysqli_stmt_bind_param($stmt, "ii", $frm_data['venue_id'], $s);
            mysqli_stmt_execute($stmt);
        };
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die("Query cannot be prepared - Insert");
    };

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    };
}

if (isset($_POST["toggle_status"])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `venues` SET `status` = ? WHERE `id` = ?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST["rem_service"])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_service']];

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
}

if (isset($_POST["add_image"])) {
    $frm_data = filteration($_POST);

    $img_r = uploadImage($_FILES['image'], VENUES_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == "upd_failed") {
        echo $img_r;
    } else {
        $q = "INSERT INTO `venue_images`(`venue_id`, `image`) VALUES (?,?)";
        $values = [$frm_data['venue_id'], $img_r];
        $res = insert($q, $values, "is");
        echo $res;
    }
}

if (isset($_POST["get_venue_images"])) {
    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `venue_images` WHERE `venue_id` = ?", [$frm_data['get_venue_images']], 'i');
    $path = VENUES_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr>
                <td><img src="$path$image" /></td>
                <td>thumb</td>
                <td>delete</td>
            </tr>

        data;
    }


}
