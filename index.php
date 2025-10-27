<?php
    if (isset($_GET['report'])) {
        $report =  $_GET['report'];
    }
    else {
        $report = "";
    }

    require __DIR__ . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "bootstrapcdnlinks.php";
    require __DIR__ . '/functions.php';
    require __DIR__ . '/database.php';
    require __DIR__ . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "header.php";
    // create the DB connection early so reports can use it when included
    $db = db();

    if ($report != ""){
        require __DIR__ . DIRECTORY_SEPARATOR . "reports" . DIRECTORY_SEPARATOR . "$report.php";
    }
    require __DIR__ . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "footer.php";

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
        if ($report != "") {
            make_A_Table($querie, $db);
        }
    ?>
    
</body>
</html>