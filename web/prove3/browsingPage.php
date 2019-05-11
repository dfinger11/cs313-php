<?php
require 'commonMethods.php';
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <title>Browsing Page</title>
    <link rel='stylesheet' href='prove3Style.css'/>
</head>
<body>
<div class="header">
    <h1 class="textHeader1">Welcome to ORDER-AND-GO</h1>
    <h2 class="textHeader2">Food ready to order</h2>
</div>
<div class="content">
    <table>
        <tr>
            <th class="bHeader" width="300px"></th>
            <th class="bHeader">Product</th>
            <th class="bHeader">Amount</th>
            <th class="bHeader">Add Item</th>
        </tr>
        <?php
        for ($i=0; $i< count($products); $i++) {
            ?>
            <tr>
                <td class="bData"><img src="<?php echo($productImages[$i]); ?>"></td>
                <td class="bData"><?php echo($products[$i]); ?></td>
                <td class="bData"><?php echo($amounts[$i]); ?></td>
                <td class="bData"><button onclick="location.href='?add=<?php echo($i); ?>';">Add to cart</button></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="5"></td>
        </tr>
    </table>
    <button class="cartButton" onclick="location.href = 'cartPage.php';">Go to Cart</button>
</div>
<div class="footer">
</div>
</body>
</html>