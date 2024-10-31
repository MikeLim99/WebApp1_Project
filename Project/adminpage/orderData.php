<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminstyling.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin panel</title>
</head>
<body>
    <div id="navbar-container"></div>
    <script src="../js/navbar.js"></script>
    <div class="showOrders">
        <h2>Order Lists</h2>
        <div class="orderlists">
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Main order</th>
                    <th>Side order</th>
                    <th>Total Price</th>
                </tr>
                <?php include "../backEnd/showOrders.php"; ?>
            </table>
        </div>
            <div class="controlPanel">
                <div class="showingpage">
                    <?php
                        if(!isset($_GET['page-nr'])){
                            $page = 1 ;
                        }else {
                            $page = $_GET['page-nr'];
                        }
                    ?>
                    Showing <?php echo $page ?> of <?php echo $pages ?> pages
                </div>
                <div class="pagecontrol">
                    <a href="?page-nr=1">First</a>
                    <?php 
                        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
                            ?>
                                <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a>
                            <?php
                        } else {
                            ?>
                                <a>Previous</a>
                            <?php
                        }
                    ?>
                    
                    <div class="pagenumbers">
                        <?php
                            for($counter = 1; $counter <= $pages; $counter ++){
                                ?>
                                    <a href="?page-nr=<?php echo $counter?>"><?php echo $counter?></a>
                                <?php
                            }
                        ?>
                    </div>

                    <?php
                        if(!isset($_GET['page-nr'])){
                            ?>
                                <a href="?page-nr=2">Next</a>
                            <?php
                        }else {
                            if($_GET['page-nr'] >= $pages) {
                                ?>
                                    <a>Next</a>
                                <?php
                            }else {
                                ?>
                                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a>
                                <?php
                            }
                        }
                    ?>
                    

                    <a href="?page-nr=<?php echo $pages ?>">Last</a>
                </div>
            </div>
    </div>
</body>
</html>