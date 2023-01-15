<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $goneQuery = mysqli_query($con, "SELECT * FROM vehiclegone ORDER BY date_left DESC");
} else {
    header("Location: ../index.php");
}

if (isset($_POST["alter"])) {
    $cid = $_POST["cid"];
    $alterQuery = "UPDATE vehiclegone SET payment = 'Received' WHERE plate = '$cid';";
    mysqli_query($con, $alterQuery);
    header("refresh: 1;");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/CSS/table.css">
    <link rel="icon" href="../Assets/Images/icon.png">
    <title>Vintage Auto</title>
</head>

<body>
    <div class="vec">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Vehicle plate</th>
                    <th>Owner</th>
                    <th>Payment</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    // LOOP TILL END OF DATA
                    while ($went = mysqli_fetch_assoc($goneQuery)) {
                    ?>
                <tr>
                    <td><?php echo $went["date_left"]; ?></td>
                    <td><?php echo $went["plate"]; ?></td>
                    <td><?php echo $went["car_owner"]; ?></td>
                    <td><?php echo $went["payment"]; ?></td>
                    <td>
                        <form action="" method="post">
                            <input name="cid" value="<?php echo $went["plate"]; ?>" style="display: none">
                            <Button class="fix-btn" type="submit" name="alter">Receive payment</Button>
                        </form>
                    </td>
                </tr>
            <?php
                    }
            ?>
            </tr>
            </tbody>
        </table>
    </div>
</body>

</html>