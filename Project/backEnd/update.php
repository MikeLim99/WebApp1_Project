<?php 

include "../database/database.php";

    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $order_id = $_GET['order_id'];

    $statement = $conn->prepare("SELECT * FROM orders WHERE order_id = $order_id");

    $statement -> execute();

    $results = $statement->fetchAll();

    if(isset($_GET['order_id'])){
        foreach($results as $row);
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
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

        function calculatePrice($menuPrices, $sides_prices, $menuName, $sideName){
            $totalPrice = $menuPrices[$menuName];
            foreach($sideName as $sides) {
                $totalPrice = $totalPrice + $sides_prices[$sides];
            }
        
            return $totalPrice;
        }

        $totalPrice = calculatePrice($menuPrices, $sides_prices, $menuName, $sideName);
        Updatefunction($menuName, $sideName, $totalPrice, $name, $email, $contactNumber, $order_id);
    }

    

    function Updatefunction($menuName, $sideName, $totalPrice, $name, $email, $contactNumber, $order_id)
{
    include "../database/database.php";
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $order_id = $_GET['order_id'];

        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $conn->prepare("UPDATE orders SET cx_name = :name, cx_email = :email, contact_number = :contactNumber, main_menu = :menuName, side_menu = :sideName, total_price = :totalPrice WHERE order_id = $order_id");

        $sideName_string = implode(", ", $sideName);

        $statement -> bindParam(':name', $name);
        $statement -> bindParam(':email', $email);
        $statement -> bindParam(':contactNumber', $contactNumber);
        $statement -> bindParam(':menuName', $menuName);
        $statement -> bindParam(':sideName', $sideName_string);
        $statement -> bindParam(':totalPrice', $totalPrice);

        $statement -> execute();

        
        
        
        header('location:../pages/index.html');
        exit;
    }
    catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>