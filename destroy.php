<?php
    include 'config.php';

    $output = get_latest_output();
    $header = "No infra is provisioned.";
    if ($output != null && $output["action"] != "destroy") {
        $header = "Destroying provisioned infra.";
        trigger_pipeline("destroy");
    }

    echo <<<EOL
    <html>
        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        </head>
        <body class="container">
            <h2>
                $header
            </h2>
        </body>
    </html> 
    EOL
?>