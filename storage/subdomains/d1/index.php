<?php
        $subdomain = array_shift((explode('.', $_SERVER['HTTP_HOST'])));
?>
<html lang="en">
        <head></head>
        <body class="index">
                <h1>Subdomain <?php echo $subdomain ?></h1>
        </body>
</html>