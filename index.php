<?php
require './Assets/db.php';
if (!empty($_SESSION["id"])) {
    header("Location: ./Pages/dashboard.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["uname"];
    $passcode = md5($_POST["psw"]);

    $fetchQuery = mysqli_query($con, "SELECT * FROM users WHERE username = '$name' OR passcode = '$passcode'");
    $row = mysqli_fetch_assoc($fetchQuery);
    if (mysqli_num_rows($fetchQuery) > 0) {
        if ($passcode == $row["passcode"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["uuid"];
            header("Location: ./Pages/dashboard.php");
        } else {
            echo "<script> alert('Incorrect username or password!'); </script>";
        }
    } else {
        echo "<script> alert('User does not exist!'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/CSS/index.css">
    <link rel="icon" href="./Assets/Images/icon.png">
    <title>Vinatage Auto</title>
</head>

<body>
    <div class="all-content">
        <div class="click">
            <h1>Welcome to the garage</h1>
            <button onclick="code()" style="width:20%;">register new user as admin</button><br>
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
        </div>
        <div id="id01" class="modal">
            <form class="modal-content animate" action="" method="post">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                    <img src="./Assets/Images/avatar.png" class="avatar">
                </div>
                <div class="form-container">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="uname" id="uname" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

                    <button type="submit" name="submit">Login</button>
                </div>
                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./Assets/modal.js"></script>
    <script>
        function code() {
            let pass = prompt("Please enter admin code:");
            if (pass == "1234") {
                window.open("./Pages/reg.php", "_blank");
            } else {
                alert("Invalid passcode");
            }
        }
    </script>
</body>

</html>