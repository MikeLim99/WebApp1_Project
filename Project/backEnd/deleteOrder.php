<?php 
include "../database/database.php";

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

if(isset($_GET['order_id'])){
    $id = $_GET['order_id'];
    $sql = "DELETE FROM orders WHERE order_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("location:../pages/viewOrder.php");
    // Now you can fetch the remaining data if needed
    // $stmt = $conn->query("SELECT * FROM orders");
    // $orders = $stmt->fetchAll();
    $conn = null;
}
?>
