<?php

function registerUser($firstName,$lastName,$gender,$email,$password,$image,$mobile,$connection)
{
    $success = false;
    
    $query = "insert into user(firstName, lastName, gender, email, password, imagePath, mobile, createDate, isActive)
              values('$firstName',
                    '$lastName',
                    '$gender',
                    '$email',
                    '$password',
                    '$image',
                    '$mobile',
                    CURDATE(),
                    'Yes')";
    $result = mysqli_query($connection,$query);
                    
    if($result == 1)
    {
        $success = TRUE;
    }
    return $success;
}

function checkUniqueEmail($connection, $emailId)
{
    $success = FALSE;
    $query = "select userId from user where email = '$emailId' ";  
    $result = mysqli_query($connection, $query); 
    $rows = mysqli_fetch_array($result);
    if($rows != '')
    {
        $success = TRUE;
    }
    return $success;
}

?>