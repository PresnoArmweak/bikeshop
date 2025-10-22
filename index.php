<?php   
    $report =  $_GET['report'];

    require __DIR__ . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "bootstrapcdnlinks.php";
    require __DIR__ . '/functions.php';
    require __DIR__ . '/database.php';
    require __DIR__ . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "header.php";
    if ($report != ""){
        require __DIR__ . DIRECTORY_SEPARATOR . "reports" . DIRECTORY_SEPARATOR . "$report.php";
    }
    require __DIR__ . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "footer.php";

    $db = db();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        if ($report != ""){
            make_A_Table($querie, $db);
        }
    ?>
    
</body>
</html>