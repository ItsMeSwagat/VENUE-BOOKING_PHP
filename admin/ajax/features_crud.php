<?php
require("../inc/db_config.php");
require("../inc/essentials.php");

if (isset($_POST["add_feature"])) {
    $frm_data = filteration($_POST);

    $q = "INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$frm_data['name']];
    $res = insert($q, $values, "s");
    echo $res;
}

if (isset($_POST["get_features"])) {
    $res = selectAll('features');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr>
                <td> $i</td>   
                <td> $row[name]</td>   
                <td>
                    <button class="btn" onclick="rem_feature($row[id])">
                        Delete
                    </button>
                </td>   

            <tr>
        data;
        $i++;
    }
}

if (isset($_POST["rem_feature"])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_feature']];

    $check_q = select("SELECT * FROM `venue_features` WHERE `features_id`=?", $values, 'i');

    if (mysqli_num_rows($check_q) == 0) {
        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($q, $values, "i");
        echo $res;
    } else {
        echo 'venue_added';
    }
}
