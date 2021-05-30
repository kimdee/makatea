<?php
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "makateaDB";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

        // $accountEmail=$_POST['accountEmail'];
        // $accountPassword=$_POST['accountPassword'];
        
        // $sql = "INSERT INTO account(accountEmail, accountPassword) VALUES ('$accountEmail','$accountPassword')";
        // if ($conn->exec($sql)) {
        //     echo json_encode(array("statusCode"=>200));
        // } else {
        //     echo json_encode(array("statusCode"=>201));
        // }

        if(count($_POST)>0){
            if ($_POST['type']==2) {
                $accountEmail       = $_POST['accountEmail'];
		        $accountPassword    = $_POST['accountPassword'];
        
                $sql = "SELECT * FROM account WHERE accountEmail='$accountEmail' AND accountPassword='$accountPassword'";
                $result = $conn->prepare($sql);
                $result->execute();
                
                if ($result->rowCount() > 0) {

                    $_SESSION['accountEmail']=$accountEmail;
                    session_start();
                    echo json_encode(array("statusCode"=>200));

                } else {

                    echo json_encode(array("statusCode"=>201));
                }
            } 
            $conn = null;
        }
    } 
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
?>