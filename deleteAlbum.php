<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Album</title>
</head>
<body>
<?php
    //Step 1 - connect to the DB
    require_once ('db.php');

    //Step 2 - Create SQL query
    $sql = "DELETE FROM albums WHERE albumID = :albumID";

    //Step 3 - prepare & execute the SQL
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':albumID', $_GET['albumID'], PDO::PARAM_INT);
    $cmd->execute();

    //Step 4 - disconnect from the DB
    $conn=null;

    //Step 5 - redirect to the albums.php page
    header('location:albums.php');
?>
</body>
</html>
<?php ob_flush(); ?>
