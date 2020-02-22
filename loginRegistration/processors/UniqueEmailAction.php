<?php

    require_once dirname(__FILE__) . '/../../include/dbconnect.php';
    require_once dirname(__FILE__) . '/../db/registrationFunction.php';
    header("Content-Type: text/json; charset=utf-8");

    $emailId = isset($_POST['emailId']) ? $_POST['emailId'] : "";         
    $uniqueEmailArray = checkUniqueEmail($connection,$emailId);
    print(json_encode($uniqueEmailArray));
    
?>