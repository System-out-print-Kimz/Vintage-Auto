<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $fetchQuery = mysqli_query($con, "SELECT * FROM vehicles WHERE fixed = 'No' ORDER BY plate");
} else {
    header("Location: ../index.php");
}

if (isset($_POST["alter"])) {
    $cid = $_POST["cid"];
    $alterQuery = "UPDATE vehicles SET fixed = 'Yes' WHERE plate = '$cid';";
    mysqli_query($con, $alterQuery);

    $copyQuery = "INSERT INTO vehiclesfixed SELECT * FROM vehicles WHERE plate = '$cid';";
    mysqli_query($con, $copyQuery);

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
    <title>Vinatage Auto</title>
</head>

<body>
    <div class="vec">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Vehicle plate</th>
                    <th>Model</th>
                    <th>Owner</th>
                    <th>Owner Contact</th>
                    <th>Issue</th>
                    <th>Fixed</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    // LOOP TILL END OF DATA
                    while ($rows = mysqli_fetch_assoc($fetchQuery)) {
                    ?>
                <tr>
                    <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                    <td><?php echo $rows["plate"]; ?></td>
                    <td><?php echo $rows["model"]; ?></td>
                    <td><?php echo $rows["car_owner"]; ?></td>
                    <td><?php echo $rows["phone"]; ?></td>
                    <td><?php echo $rows["issue"]; ?></td>
                    <td><?php echo $rows["fixed"]; ?></td>
                    <td>
                        <form action="" method="post">
                            <input name="cid" value="<?php echo $rows["plate"]; ?>" style="display: none">
                            <Button class="fix-btn" type="submit" name="alter">Move</Button>
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