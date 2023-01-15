<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $fetchQuery = mysqli_query($con, "SELECT * FROM vehicles ORDER BY plate");
} else {
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $plate = $_POST["vplate"];
    $model = $_POST["vmodel"];
    $owner = $_POST["oname"];
    $contact = $_POST["phone"];
    $issue = $_POST["prob"];

    $duplicate = mysqli_query($con, "SELECT * FROM vehicles WHERE plate = '$plate'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Vehicle already in'); </script>";
    } else {
        $insertQuery = "INSERT INTO vehicles (plate, model, car_owner, phone, issue, fixed) VALUES ('$plate', '$model', '$owner', '$contact', '$issue', 'No')";
        mysqli_query($con, $insertQuery);

        header("refresh: 1;");
    }
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
        <div class="btns">
            <button class="add-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Vehicle</button>
            <a href="workedVehicles.php"><button class="add-btn" style="width:auto;">Vehicles Working On</button></a>
            <a href="vehiclesFixed.php"><button class="add-btn" style="width:auto;">Fixed Vehicles</button></a>
        </div>
        <table class=" styled-table">
            <thead>
                <tr>
                    <th>Vehicle plate</th>
                    <th>Model</th>
                    <th>Owner</th>
                    <th>Owner Contact</th>
                    <th>Issue</th>
                    <th>Fixed</th>
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
                </tr>
            <?php
                    }
            ?>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="form-container">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="../Assets/Images/car.png" class="avatar">
                </div>
                <label for="vplate"><b>Vehicle Plate</b></label>
                <input type="text" placeholder="Enter Plate" name="vplate" id="vplate" required>

                <label for="vmodel"><b>Model</b></label>
                <input type="text" placeholder="Enter Model" name="vmodel" id="vmodel" required>

                <label for="oname"><b>Owner</b></label>
                <input type="text" placeholder="Enter Name" name="oname" id="oname" required>

                <label for="phone"><b>Owner Phone Number</b></label>
                <input type="number" placeholder="Enter Phone number" name="phone" id="phone" required>

                <label for="prob"><b>Issue</b></label>
                <input type="text" placeholder="Enter Issue" name="prob" id="prob" required>

                <button class="add-btn" type="submit" name="submit">Add</button>
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>
    <script src="../Assets/modal.js"></script>
</body>

</html>