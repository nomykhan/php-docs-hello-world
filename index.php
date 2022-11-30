<?php
echo <<<EOL
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    </head>
    <body class="container">
        <p>
            <form action="deploy.php" method="post">
                <input class="btn btn-large" type="submit" value="Create infrastructure" /> 
            </form>
            <form action="destroy.php" method="post">
                <input class="btn btn-large" type="submit" value="Destroy infrastructure" /> 
            </form>
        </p>
    </body>
</html> 
EOL;

?>