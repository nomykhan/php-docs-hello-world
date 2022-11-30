<?php
    $PROJECT_ID = "41394537";
    $GITLAB_TOKEN = "glptt-7203891bbe0184b8b012d251bf221f5c3cbc0947";
    $OUTPUT_PATH = "../data/output.json";

    function trigger_pipeline($action) {
        global $PROJECT_ID, $GITLAB_TOKEN;

        $url = "https://gitlab.com/api/v4/projects/$PROJECT_ID/ref/main/trigger/pipeline?token=$GITLAB_TOKEN&";

        if ($action == "deploy") {
            $url = $url . "variables[RUN_DEPLOY_JOB]=true";
        } else if ($action == "destroy") {
            $url = $url . "variables[RUN_DESTROY_JOB]=true";
        } else {
            echo "Invalid action";
            exit;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function get_latest_output() {
        global $OUTPUT_PATH;

        if (file_exists($OUTPUT_PATH)) {
            return json_decode(file_get_contents($OUTPUT_PATH), true);
        }
        return null;
    }

    function update_output($action, $success, $output) {
        global $OUTPUT_PATH;

        file_put_contents($OUTPUT_PATH, json_encode(array(
            "action" => $action,
            "success" => $success,
            "output" => $output
        )));
    }
?>
