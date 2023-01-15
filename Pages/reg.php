<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    header("Location: dashboard.php");
}

echo "<script>function code() {
            let pass = prompt('Please re-enter admin code:');
            if (pass == '1234') {
                alert('Correct');
            } else {
                alert('Invalid passcode');
                window.open('index.php', '_self');
            }
        }
        code();
        </script>";

if (isset($_POST["submit"])) {
    $name = $_POST["username"];
    $passcode = md5($_POST["password"]);
    $cpasscode = md5($_POST["cpassword"]);

    $duplicate = mysqli_query($con, "SELECT * FROM users WHERE username = '$name'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username taken'); </script>";
    } else {
        if ($passcode == $cpasscode) {
            $insertQuery = "INSERT INTO users (username, passcode) VALUES ('$name', '$passcode')";
            mysqli_query($con, $insertQuery);
        } else {
            echo "<script> alert('Passwords do not match'); </script>";
        }
        echo "<script> alert('Success!'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/CSS/regform.css" />
    <link rel="icon" href="../Assets/Images/icon.png">
    <title>Registration</title>
</head>

<body>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" id="username" placeholder="Username" required />
        <input type="password" class="login-input" name="password" id="password" placeholder="Password" required>
        <input type="password" class="login-input" name="cpassword" id="cpassword" placeholder="Confirm password" required>
        <input type="submit" name="submit" class="login-button">
    </form>
</body>

</html>