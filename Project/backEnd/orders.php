<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/phpstyling.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Order received!</title>
</head>
<body>
    <div id="navbar-container"></div>
    <script src="../js/navbar.js"></script>
<?php
include "../database/database.php";

function displayOrder(){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $menuPrices = [
            'QuarterPounder' => 50,
            'Overload' => 36,
            'Cheeseburger' => 26,
            'Friednoodles' => 40,
        ];

        $sides_prices = [
            'Fries' => 15,
            'KwekKwek' => 20,
            'Squidballs' => 10,
            'Fishballs' => 10,
            'Kikiam' => 10,
            'Veggieballs' => 5,
        ];
        
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $contactNumber = htmlspecialchars($_POST['contactNumber']);

        $menuName = $_POST['menuName'];
        if(isset($_POST['sideName'])) {
            $sideName = $_POST['sideName'];
        }else {
            $sideName = [];
        }

        $totalPrice = calculatePrice($menuPrices, $sides_prices, $menuName, $sideName);

        

        echo "<section>";   
        echo "<div class='orderSummary'>";
        echo "<h2> 📝 Order Summary </h2>";

        echo "<div class='orderInfo'>";
        echo "<table>";
        echo "<tr><td>Name</td><td>" . htmlspecialchars($name) . "</td></tr>";
        echo "<tr><td>Main menu</td><td>" . htmlspecialchars($menuName) . "(₱". number_format($menuPrices[$menuName],2) . ")</td></tr>";
        echo "<tr><td>Sides</td><td>" . implode(', ', $sideName) . "(₱". number_format(array_sum(array_intersect_key($sides_prices, array_flip($sideName))),2) . ")</td></>";
        echo "<tr><td>Total price</td><td>" . "₱". number_format($totalPrice, 2) . "</td></tr>";
        echo "</table>";
        echo "</div>";
        echo "</section>";
        addToDatabase($menuName, $sideName, $totalPrice, $name, $email, $contactNumber);
        echo "</div>";

    }
}

function calculatePrice($menuPrices, $sides_prices, $menuName, $sideName){
    $totalPrice = $menuPrices[$menuName];
    foreach($sideName as $sides) {
        $totalPrice = $totalPrice + $sides_prices[$sides];
    }

    return $totalPrice;
}

displayOrder();

function addToDatabase($menuName, $sideName, $totalPrice, $name, $email, $contactNumber)
{
    include "../database/database.php";
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $conn->prepare("INSERT INTO orders (cx_name, cx_email, contact_number, main_menu, side_menu, total_price) VALUES (:name, :email, :contactNumber, :menuName, :sideName, :totalPrice)");

        $sideName_string = implode(", ", $sideName);
        $statement -> bindParam(':name', $name);
        $statement -> bindParam(':email', $email);
        $statement -> bindParam(':contactNumber', $contactNumber);
        $statement -> bindParam(':menuName', $menuName);
        $statement -> bindParam(':sideName', $sideName_string);
        $statement -> bindParam(':totalPrice', $totalPrice);

        $statement -> execute();

        $orderId = $conn->lastInsertId();
        echo "<script>alert('Thank you! Your order has been sent to the database.');</script>";
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

?>
</body>
</html>


