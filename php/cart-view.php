<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "makateadb";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM orders 
        INNER JOIN customer ON orders.customerID = customer.customerID 
        INNER JOIN products ON orders.productID = products.productID";
$result = $conn->prepare($sql);
$result->execute();

if ($result->rowCount()>0) {
    $row = $result->fetchAll();
        foreach ($row as $key => $rows) {	
?>	
    <tr>
        <td><?=++$key;?></td>
		<td><?=$rows['productName'];?></td>
		<td><?=$rows['productDescription'];?></td>
        <td><?=$rows['orderQuantity'];?></td>
		<td><?=$rows['productPrice'];?></td>
        <td class="text-right">
            <button class="btn bg-gradient-danger my-1 me-1" data-bs-toggle="modal" data-bs-target="#modal-delete-cart"  id="btn-delete"
                data-orderID="<?php echo $rows['orderID']; ?>" >
                Delete
            </button>
        </td>
	</tr>
<?php	
    }
}
else {
    echo "0 results";
}
$conn = null;
?>