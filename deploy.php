<?php
    include "config.php";

    $output = get_latest_output();
    if ($output == null || $output["action"] == "destroy") {
        trigger_pipeline("deploy");
    }

    echo <<<EOL
    <html>
        <head>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
        </head>
        <body class="container">
            <h2 id="status">Checking status...</h2>
            <pre id="output" style="display:none"></pre>

            <script>
                var headerEl = document.getElementById("status");
                var outputEl = document.getElementById("output");
                var interval = setInterval(function() {
                    var req = new XMLHttpRequest();
                    req.open("GET", "output.php?check-status=true", true);
                    req.send();
                    req.onreadystatechange = function() {
                        if (req.readyState == 4 && req.status == 200) {
                            var data = JSON.parse(req.responseText);
                            if (data.output == null || data.action == "destroy") {
                                headerEl.innerHTML = "Deploying infrastructure...";
                                return;
                            }

                            headerEl.innerHTML = "Infra is deployed.";
                            outputEl.innerHTML = data.output;
                            outputEl.style.display = "block";

                            clearInterval(interval);
                        }
                    }
                }, 2000);
            </script>
        </body>
    </html> 
    EOL;

?>