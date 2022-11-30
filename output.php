<?php
    include "config.php";
    
    if (isset($_GET["check-status"])) {
        $output = get_latest_output();
        
        if ($output != null) {
            echo json_encode($output);
            return;
        }

        echo json_encode(array(
            "output" => null
        ));
        return;
    }

    if ($_GET["action"] == "deploy") {
        update_output("deploy", $_GET["success"] == "true", file_get_contents($_FILES['output']['tmp_name']));
    }
    else if ($_GET["action"] == "destroy") {
        update_output("destroy", $_GET["success"] == "true", file_get_contents($_FILES['output']['tmp_name']));
    }
?>