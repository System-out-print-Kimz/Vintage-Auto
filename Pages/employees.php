<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $fetchQuery = mysqli_query($con, "SELECT * FROM employees");
} else {
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $EID = $_POST["eid"];
    $NAME = $_POST["ename"];
    $contact = $_POST["phone"];
    $DESIGN = $_POST["design"];

    $duplicate = mysqli_query($con, "SELECT * FROM employees WHERE E_id = '$EID'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('E_ID already in'); </script>";
    } else {
        $insertQuery = "INSERT INTO employees (E_id, name_, phone, designation) VALUES ('$EID', '$NAME', '$contact', '$DESIGN')";
        mysqli_query($con, $insertQuery);

        header("refresh: 1;");
    }
}

if (isset($_POST["delete"])) {
    $cid = $_POST["cid"];
    $deleteQuery = "DELETE FROM employees WHERE E_id = '$cid';";
    mysqli_query($con, $deleteQuery);

    echo "<script> alert('Employee removed'); </script>";
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
    <link rel="stylesheet" href="../Assets/CSS/modal.css">
    <link rel="icon" href="../Assets/Images/icon.png">
    <title>Vinatage Auto</title>
</head>

<body>
    <div class="vec">
        <div class="btns">
            <button class="add-btn" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Employee</button>
        </div>
        <table class=" styled-table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Designation</th>
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
                    <td><?php echo $rows["E_id"]; ?></td>
                    <td><?php echo $rows["name_"]; ?></td>
                    <td><?php echo $rows["phone"]; ?></td>
                    <td><?php echo $rows["designation"]; ?></td>
                    <td>
                        <form action="" method="post">
                            <input name="cid" value="<?php echo $rows["E_id"]; ?>" style="display: none">
                            <Button class="fix-btn" type="submit" name="delete">Fire</Button>
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
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <div class="form-container">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="../Assets/Images/stylish-boy-avatar.png" class="avatar">
                </div>
                <label for="eid"><b>Employee ID</b></label>
                <input type="number" placeholder="Enter ID" name="eid" id="eid" required>

                <label for="ename"><b>Employee Name</b></label>
                <input type="text" placeholder="Enter Name" name="ename" id="ename" required>

                <label for="phone"><b>Employee Phone Number</b></label>
                <input type="number" placeholder="Enter Phone number" name="phone" id="phone" required>

                <label for="design"><b>Designation</b></label>
                <input type="text" placeholder="Enter Designation" name="design" id="design" required>

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