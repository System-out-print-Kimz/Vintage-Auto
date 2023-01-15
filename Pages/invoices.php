<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $fetchQuery = mysqli_query($con, "SELECT * FROM invoices ORDER BY date_invoiced DESC");
} else {
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $inv_number = $_POST["invid"];
    $inv_to = $_POST["cowner"];
    $inv_to_contact = $_POST["ctct"];
    $pay_for = $_POST["pment"];
    $pay_amt = $_POST["currency"];


    $_SESSION["invoice"] = $inv_number;
    $_SESSION["name"] = $inv_to;
    $_SESSION["address"] = $inv_to_contact;
    $_SESSION["service"] = $pay_for;
    $_SESSION["amount"] = $pay_amt;

    header("Location: inv.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/CSS/table.css">
    <link rel="stylesheet" href="../Assets/CSS/modal.css">
    <link rel="icon" href="../Assets/Images/icon.png">
    <title>Vinatage Auto</title>
</head>

<body>
    <div class="vec">
        <table class=" styled-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Inv. Number</th>
                    <th>Vehicle Plate</th>
                    <th>Owner</th>
                    <th>Owner Contact</th>
                    <th>Service</th>
                    <th>Amount Billed</th>
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
                    <td><?php echo $rows["date_invoiced"]; ?></td>
                    <td><?php echo $rows["invoice"]; ?></td>
                    <td><?php echo $rows["plate"]; ?></td>
                    <td><?php echo $rows["car_owner"]; ?></td>
                    <td><?php echo $rows["contact"]; ?></td>
                    <td><?php echo $rows["servicing"]; ?></td>
                    <td><?php echo $rows["amount"]; ?></td>
                    <td>
                        <form action="" method="post">
                            <input name="invid" type="text" value="<?php echo $rows["invoice"]; ?>" style="display: none;">
                            <input name="cowner" type="text" value="<?php echo $rows["car_owner"]; ?>" style="display: none;">
                            <input name="ctct" type="number" value="<?php echo $rows["contact"]; ?>" style="display: none;">
                            <input name="pment" type="text" value="<?php echo $rows["servicing"]; ?>" style="display: none;">
                            <input name="currency" type="text" value="<?php echo $rows["amount"]; ?>" style="display: none;">

                            <Button class="fix-btn" type="submit" name="submit">Print</Button>
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