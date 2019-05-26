<?php
session_start();
if(isset($_SESSION['authentication']) && $_SESSION['authentication'] == true) {
    $username = $_SESSION['username'];
    $db = get_db();
    ?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'/>
    <meta name='viewport'
    <title>Family Room</title>
    <link rel='stylesheet' href=''/>
    <script src=""></script>
</head>
<body>
<div class="page">
    <div class="header">
        <h1 class="textHeader1">The Family Room</h1>
        <h2 class="textHeader3">Here you can see your family members</h2>
    </div>
    <div class="content">
        <?php
        $statement = $db->prepare("SELECT family_name FROM family WHERE family_pk=
                                     (
                                         SELECT DISTINCT ON (family_fk) family_fk FROM familymember WHERE user_pk=
                                              (
                                                  SELECT user_pk FROM famusers WHERE username='DarthVader'
                                              )
                                     );
");
        $statement->execute();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            // The variable "row" now holds the complete record for that
            // row, and we can access the different values based on their
            // name
            $famName = $row['family_name'];
            $chapter = $row['chapter'];
            $verse = $row['verse'];
            $content = $row['content'];
            echo "<h3>$famName Family</h3>";
        }
        ?>
    </div>
    <div class="footer">

    </div>
</div>
</body>

    <?php
} else {
    header("Location: login.php");
}
?>
Welcome
