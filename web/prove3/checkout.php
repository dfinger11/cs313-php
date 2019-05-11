<?php session_start();
//Define the products and cost
require 'commonMethods.php';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Checkout</title>
    <link rel='stylesheet' href='prove3Style.css'/>
</head>
<body>
<div class="header">
    <h1 class="textHeader1">ORDER-AND-GO</h1>
    <h1 class="textHeader2">Checkout</h1>
</div>
<div class="content">
    <?php
    if ( isset($_SESSION["cart"]) and !empty($_SESSION["cart"]) ) {
        ?>
        <form action="confirmation.php" method="post">
            <table>
                <tr>
                    <th class="tbHeader">Product</th>
                    <th width="10px"></th>
                    <th class="tbHeader">Qty</th>
                    <th width="10px"></th>
                    <th class="tbHeader">Amount</th>
                </tr>
                <?php
                $total = 0;
                foreach ( $_SESSION["cart"] as $i ) {
                    ?>
                    <tr>
                        <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
                        <td width="10px"></td>
                        <td><?php echo( $_SESSION["qty"][$i] ); ?></td>
                        <td width="10px"></td>
                        <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
                        <td width="10px"></td>
                    </tr>
                    <?php
                    $total = $total + $_SESSION["amounts"][$i];
                }
                $_SESSION["total"] = $total;
                ?>
            </table>
            <h3>Total : <?php echo($total); ?></h3>
            <h2>Please enter the preferred shipping address:</h2>
            <b>Address Line 1: </b>
            <input type="text" name="add1" value="">
            <br>
            <b>Address Line 2: </b>
            <input type="text" name="add2" value="">
            <br>
            <b>City: </b>
            <input type="text" name="city" value="">
            <br>
            <b>State: </b>
            <input type="text" name="state" value="">
            <br>
            <b>Zipcode: </b>
            <input type="text" name="zip" value="">
            <br>
            <b>Country: </b>
            <input type="text" name="country" value="">
            <br>
            <br>
            <button class="cartButton" onclick="location.href = 'cartPage.php';">Back to cart</button>
            <button class="cartButton" onclick="location.href = 'confirmation.php';">Confirm</button>
        </form>
        <?php
    } else {
        ?>
        <h2>Your cart is empty.</h2>
        <button class="cartButton" onclick="location.href = 'browsingPage.php';">Back to Browsing</button>
        <?php
    }
    ?>

</div>
<div class="footer">

</div>
</body>
</html>