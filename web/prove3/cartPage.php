<?php session_start();
require 'commonMethods.php';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Shopping Cart</title>
    <link rel='stylesheet' href='prove3Style.css'/>
</head>
<body>
<div class="header">
    <h1 class="textHeader1">ORDER-AND-GO</h1>
    <h1 class="textHeader2">Cart</h1>
</div>
<div class="content">
    <?php
    if ( isset($_SESSION["cart"]) and !empty($_SESSION["cart"]) ) {
        ?>
        <table>
            <tr>
                <th class="tbHeader">Product</th>
                <th width="10px"></th>
                <th class="tbHeader">Qty</th>
                <th width="10px"></th>
                <th class="tbHeader">Amount</th>
                <th width="10px"></th>
                <th class="tbHeader">Add Item</th>
                <th width="10px"></th>
                <th class="tbHeader">Remove Item</th>
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
                    <td><button onclick="location.href='?add=<?php echo($i); ?>';">Add to cart</button></td>
                    <td width="10px"></td>
                    <td><button onclick="location.href='?delete=<?php echo($i); ?>';">Add to cart</button></td>
                </tr>
                <?php
                $total = $total + $_SESSION["amounts"][$i];
            }
            $_SESSION["total"] = $total;
            ?>
        </table>
        <h3>Total : <?php echo($total); ?></h3>
        <br>
        <button class="cartButton" onclick="location.href = 'browsingPage.php';">Back to browsing</button>
        <button class="cartButton" onclick="location.href = 'checkout.php';">Proceed to checkout</button>
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