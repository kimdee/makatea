<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname="makateadb";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

        session_start();

        // SAVE
        if(count($_POST)>0){
            if($_POST['type']==1){
                $customerFirstName       = $_POST['customerFirstName'];
                $customerLastName        = $_POST['customerLastName'];
                $customerAddress         = $_POST['customerAddress'];
                $customerContact         = $_POST['customerContact'];
                $customerUserName        = $_POST['customerUserName'];
                $customerPassword        = $_POST['customerPassword'];
                
                $sql = "INSERT INTO customer (customerFirstName, customerLastName, customerAddress, customerContact, customerUserName, customerPassword) VALUES 
                ('$customerFirstName','$customerLastName','$customerAddress','$customerContact','$customerUserName','$customerPassword')";
                                       
                if ($conn->exec($sql)) {
                    echo json_encode(array("statusCode"=>200));
                } else {
                    echo json_encode(array("statusCode"=>201));
                }
            }
        }

        // EDIT
        if(count($_POST)>0){
            if ($_POST['type']==2) {
                $customerID                   = $_POST['customerIDEdit'];
                $customerFirstName            = $_POST['customerFirstNameEdit'];
                $customerLastName             = $_POST['customerLastNameEdit'];
                $customerAddress              = $_POST['customerAddressEdit'];
                $customerContact              = $_POST['customerContactEdit'];
                $customerUserName             = $_POST['customerUserNameEdit'];
                $customerPassword             = $_POST['customerPasswordEdit'];

                $sql = "UPDATE customer SET customerFirstName='$customerFirstName', customerLastName='$customerLastName', customerAddress='$customerAddress',
                 customerContact='$customerContact', customerUserName='$customerUserName', customerPassword='$customerPassword' WHERE customerID='$customerID'";
                    
                if ($conn->exec($sql)) {
                    echo json_encode(array("statusCode"=>200));
                } else {
                    echo json_encode(array("statusCode"=>201));
                }
            } 
        }

        // DELETE
        if(count($_POST)>0){
            if ($_POST['type']==3) {
                $orderID          = $_POST['orderID'];

                $sql = "DELETE FROM orders WHERE orderID=$orderID";
                
                if ($conn->exec($sql)) {
                    echo json_encode(array("statusCode"=>200));
                } else {
                    echo json_encode(array("statusCode"=>201));
                }
            } 
        }

      
        $conn = null;
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    } 
  

?>