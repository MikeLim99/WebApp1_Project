<?php
include "../database/database.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    
    // if(isset($_GET['order_id'])){
    //     $id = $_GET['order_id'];
    //     $delete = mysqli_query($conn, "DELETE FROM orders WHERE order_id = '$id'");
    //     header("location:../pages/viewOrder.php");
    // }

    if($conn->connect_error){
        die("connection failed" . $conn->connect_error);
    }

    $id = $_POST['orderId'];
    $sql = "SELECT * FROM orders WHERE order_id = $id";
    $result = $conn->query($sql);

    if(!$result){
        die ("Invalid query: " . $conn->connect_error);
    }else {
        while($row = $result->fetch_assoc()){
            echo
            "<tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Main Order</th>
                <th>Side Order</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>";
            
            echo 
        '
        <tr>
        <td>' .$row['order_id'] .'</td>
        <td>' .'<input type="text" id="updateField" value="'.$row['cx_name'].'" disabled>' .'</td>
        <td>' .'<input type="text" id="updateField" value="'.$row['cx_email'].'" disabled>' .'</td>
        <td>' .'<input type="text" id="updateField" value="'.$row['contact_number'].'" disabled>' .'</td>
        <td>' .'<input type="text" id="updateField" value="'.$row['main_menu'].'" disabled>'.'</td>
        <td>' . $row['side_menu'] .'</td>
        <td>' .$row['total_price'].'</td>
        <td>
            <button><a href="../pages/updateForm.php?order_id='. $row['order_id'] .'"><i class="fa-regular fa-pen-to-square"></i></a></button>
            <a href="viewOrder.php?order_id='. $row['order_id'] .'"><i class="fa-solid fa-trash" style="color: #ff4d70;"></i></a>
        </td>
        </tr>';
        
        }
    }   
    
    
}
?>
