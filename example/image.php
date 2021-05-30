<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "makateadb";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

     if($_POST["action"] == "insert")  {
      $file = addslashes(file_get_contents($_FILES["images"]["tmp_name"]));

      $sql = "INSERT INTO img (img) VALUES ('$file')";

      if ($conn->exec($sql)) {
        echo 'SAVE';
        } else {
            echo 'ERROR';
        }
     }
?>