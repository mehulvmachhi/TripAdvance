<?php
    if (!isset($_SESSION)) 
    {
        session_start();
    }    
?>
<?php
    
    function verifyUser($email,$password,$connection)
    {        
        $loggedTripUser = NULL;
        $query = "select    userId,
                            firstName,
                            lastName,
                            email,
                            imagePath
                  from      user
                  where     email = '$email'
                  and       password = '$password'
                  and       isActive = 'Yes'";
//        echo $query;
//        exit();
        $result = mysqli_query($connection,$query);
        $rows = mysqli_num_rows($result);        
//        print_r($result);
//        exit();
        if($rows == 1)
        {
            while($row = mysqli_fetch_array($result))
            {
                $loggedTripUser = array('id' => $row['userId'],
                                        'firstName' => $row['firstName'],
                                        'lastName' => $row['lastName'],
                                        'email' => $row['email'],
                                        'image' => $row['imagePath']);                
            }
        }
        return $loggedTripUser;
    }

?>