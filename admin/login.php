<?php
include '../connection.php';

//POST= send/save data to mysql db
//GET= retrive/read data from mysql db
//md5=make the password into binary code and secure password

$adminEmail = $_POST['admin_email'];
$adminPassword = md5($_POST['admin_password']);//make password into binary form

$sqlQuery = "SELECT * From admin_table WHERE admin_email = '$adminEmail'AND admin_password = '$adminPassword'";

$resultOfQuery= $connectNow->query($sqlQuery);

if ($resultOfQuery->num_rows > 0)// allow user to login
{
    $userRecord = array();
    while($rowFound = $resultOfQuery->fetch_assoc())
    {
        $userRecord[] = $rowFound;
    }

    echo json_encode(
        array("success"=>true,
              "userData"=>$adminRecord[0],
        )
    );
}
else //don't allow user to login
{
    echo json_encode(array("success"=>false));
}

