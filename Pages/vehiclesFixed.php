<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $fetchQuery = mysqli_query($con, "SELECT * FROM vehiclesfixed");
} else {
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $cid = $_POST["cid"];

    $inv_to = $_POST["cowner"];
    $inv_to_contact = $_POST["ctct"];
    $pay_for = $_POST["pment"];
    $pay_amt = $_POST["currency"];
    $inv_number = uniqid();
    $date = date("Y-m-d");

    $goneQuery = "INSERT INTO vehiclegone (date_left, plate, car_owner, payment) VALUES ('$date', '$cid', '$inv_to', 'Pending')";
    mysqli_query($con, $goneQuery);
    $invoiceQuery = "INSERT INTO invoices (date_invoiced, invoice, plate, car_owner, contact, servicing, amount) VALUES ('$date', '$inv_number', '$cid', '$inv_to', '$inv_to_contact', '$pay_for', '$pay_amt')";
    mysqli_query($con, $invoiceQuery);
    $deleteQuery = "DELETE FROM vehiclesfixed WHERE plate = '$cid';";
    mysqli_query($con, $deleteQuery);
    $delQuery = "DELETE FROM vehicles WHERE plate = '$cid';";
    mysqli_query($con, $delQuery);

    header("Location: invoices.php");
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
                    <th>Invoicing</th>
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
                            <input name="cid" type="text" value="<?php echo $rows["plate"]; ?>" style="display: none;">
                            <input name="cowner" type="text" value="<?php echo $rows["car_owner"]; ?>" style="display: none;">
                            <input name="ctct" type="number" value="<?php echo $rows["phone"]; ?>" style="display: none;">
                            <input name="pment" type="text" value="<?php echo $rows["issue"]; ?>" style="display: none;">

                            <label for="currency"><b>Amount due</b></label>
                            <input type="number" name="currency" id="currency" required>
                            <Button type="submit" name="submit">Invoice</Button>
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