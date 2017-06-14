<?php

    $email = $_POST['email'];
    require_once ('db.php');
    $password=$email;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = :password WHERE email=:email";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':email', $email, PDO::PARAM_STR, 120);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);


?>
