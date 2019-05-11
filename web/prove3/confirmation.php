<?php
require 'commonMethods.php';

$userAddress = htmlspecialchars($_POST['add1']) . " " . htmlspecialchars( $_POST['add2']) . ", "
    . htmlspecialchars($_POST['city']) . ", ". htmlspecialchars($_POST['state']) . ", " . htmlspecialchars($_POST['zip']) . ", "
    . htmlspecialchars($_POST['country'])
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Confirmation</title>
    <link rel='stylesheet' href='prove3Style.css'/>
</head>
<body>
<div class="header">
    <h1 class="textHeader1">ORDER-AND-GO</h1>
    <h1 class="textHeader2">Confirmation</h1>
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
        <h2>Shipping Address:</h2>
        <p><?php echo htmlspecialchars($userAddress)?></p>
        <button onclick="location.href = 'browsingPage.php';">Back to Browsing</button>
        <?php
    } else {
        ?>
        <button onclick="location.href = 'browsingPage.php';">Back to Browsing</button>
        <?php
    }
    ?>

</div>
<div class="footer">

</div>
</body>
</html>