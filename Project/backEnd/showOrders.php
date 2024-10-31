<?php
include "../database/database.php";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $startPage = 0;

    $rowsPerPage = 5;

    $records = $conn->query("SELECT * FROM orders");

    $nr_of_rows = $records->rowCount();

    $pages = ceil($nr_of_rows / $rowsPerPage);

    if(isset($_GET['page-nr'])){
        $page = $_GET['page-nr'] - 1;
        $startPage = $page * $rowsPerPage;
    }

    $statement = $conn->prepare("SELECT * FROM orders LIMIT $startPage, $rowsPerPage");

    $statement -> execute();

    $results = $statement->fetchAll();

    foreach($results as $result){
        echo "<tr>";
        echo "<td>" . $result['order_id'] . "</td>";
        echo "<td>" . $result['cx_name'] . "</td>";
        echo "<td>" . $result['cx_email'] . "</td>";
        echo "<td>" . $result['contact_number'] . "</td>";
        echo "<td>" . $result['main_menu'] . "</td>";
        echo "<td>" . $result['side_menu'] . "</td>";
        echo "<td>" . $result['total_price'] . "</td>";
        echo "</tr>";
    }
    }catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>