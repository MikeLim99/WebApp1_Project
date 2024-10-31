<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>KFC - pambayan!</title>
    <title>Document</title>
</head>
<body>
    <?php include "../backEnd/update.php"; ?>
    <section id="customizedOrder">
        <div class="central-div">
            <h2>Make your customized order</h2>
        </div>
        <class class="orderForm">
            <form method="post" id="orderForm">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <div class="information">
                    <h3>Please fill up the form</h3>
                </div>
                <div class="info">
                    <div class="inputfield">
                        <input type="text" name="name" id="name" value="<?php echo $row['cx_name']; ?>" required>
                        <label for="name" class="userInput">Name :</label>
                    </div>
                    <div class="inputfield">
                        <input type="email" name="email" id="email" value="<?php echo $row['cx_email']; ?>" required>
                        <label for="name" class="userInput">Email :</label>
                    </div>
                    <div class="inputfield">
                        <input type="tel" name="contactNumber" id="contactNumber" value="<?php echo $row['contact_number']; ?>" required>
                        <label for="name" class="userInput">Contact number :</label>
                    </div>
                </div>
                <div class="information">
                    <h3>Choose from the menu</h3>
                </div>
                <div class="lists">
                    <div class="MenuList">
                        <input type="radio" name="menuName" id="QuarterPounder" value="QuarterPounder">
                        <div class="radioTile">
                            <img src="../assets/1.jpg" alt="">
                            <label for="QuarterPounder" class="MenuListIcons">Quarter-Pounder</label>
                            <label for="price">₱50.00</label>
                        </div>
                    </div>
                    <div class="MenuList">
                        <input type="radio" name="menuName" id="Overload" value="Overload">
                        <div class="radioTile">
                            <img src="../assets/1.jpg" alt="">
                            <label for="Quarter-Pounder" class="MenuListIcons">Overload</label>
                            <label for="price">₱36.00</label>
                        </div>
                    </div>
                    <div class="MenuList">
                        <input type="radio" name="menuName" id="Cheeseburger" value="Cheeseburger">
                        <div class="radioTile">
                            <img src="../assets/1.jpg" alt="">
                            <label for="Cheeseburger" class="MenuListIcons">Cheese-burger</label>
                            <label for="price">₱26.00</label>
                        </div>
                    </div>
                    <div class="MenuList">
                        <input type="radio" name="menuName" id="Friednoodles" value="Friednoodles">
                        <div class="radioTile">
                            <img src="../assets/1.jpg" alt="">
                            <label for="Friednoodles" class="MenuListIcons">Fried noodles</label>
                            <label for="price">₱40.00</label>
                        </div>
                    </div>
                </div>
                <div class="information">
                    <h3>Choose your sides</h3>
                </div>
                <div class="sides lists">
                    <div class="sideLists">
                        <input type="checkbox" name="sideName[]" id="Fries" value="Fries">
                        <label for="">Fries ₱15.00</label>
                    </div>
                    <div class="sideLists">
                        <input type="checkbox" name="sideName[]" id="KwekKwek" value="KwekKwek">
                        <label for="">Kwek Kwek ₱20.00</label>
                    </div>
                    <div class="sideLists">
                        <input type="checkbox" name="sideName[]" id="Squidballs" value="Squidballs">
                        <label for="Squidballs">Squid balls ₱10.00</label>
                    </div>
                    <div class="sideLists">
                        <input type="checkbox" name="sideName[]" id="Fishballs" value="Fishballs">
                        <label for="">Fish balls ₱10.00</label>
                    </div>
                    <div class="sideLists">
                        <input type="checkbox" name="sideName[]" id="Kikiam" value="Kikiam">
                        <label for="Kikiam">Kikiam ₱10.00</label>
                    </div>
                    <div class="sideLists">
                        <input type="checkbox" name="sideName[]" id="Veggieballs" value="Veggieballs">
                        <label for="Veggieballs">Veggie balls ₱5.00</label>
                    </div>
                </div>
                <div class="btns">
                    <button class="checkData"><a href="../pages/viewOrder.php">Check Order</a></button>
                    <button class="submitBtn" name="action" value="addOrder">Submit</button>
                    <button class="clearBtn" onclick="clearFrom()" value="Reset form">Clear selection</button>
                </div>
            </form>
            

            
        </div>
    </section>

    <script>
        function clearFrom(){
            document.getElementById('orderForm').reset();
        }
    </script>
</body>
</html>