<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $fetchQuery = mysqli_query($con, "SELECT * FROM users WHERE uuid = '$id'");
    $row = mysqli_fetch_assoc($fetchQuery);

    $goneQuery = mysqli_query($con, "SELECT * FROM vehiclegone ORDER BY date_left DESC LIMIT 8");
    $vehicleQuery = mysqli_query($con, "SELECT COUNT(*) AS vecs FROM vehicles");
    $vec = mysqli_fetch_assoc($vehicleQuery);
    $workingQuery = mysqli_query($con, "SELECT COUNT(*) AS wor FROM vehicles WHERE fixed = 'No'");
    $work = mysqli_fetch_assoc($workingQuery);
    $fixedQuery = mysqli_query($con, "SELECT COUNT(*) AS fixed FROM vehiclesfixed");
    $fix = mysqli_fetch_assoc($fixedQuery);
    $leftQuery = mysqli_query($con, "SELECT COUNT(*) AS gone FROM vehiclegone");
    $left = mysqli_fetch_assoc($leftQuery);
    $employeeQuery = mysqli_query($con, "SELECT COUNT(*) AS empl FROM employees");
    $emp = mysqli_fetch_assoc($employeeQuery);
} else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Assets/CSS/dashboard.css">
    <link rel="stylesheet" href="../Assets/CSS/table.css">
    <link rel="icon" href="../Assets/Images/icon.png">
    <title>Vintage Auto</title>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bx-building-house'></i>
            <span class="logo_name">Vintage Auto</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#" class="active">
                    <i class='fa fa-home'></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="vehicles.php">
                    <i class='fa fa-car'></i>
                    <span class="links_name">Vehicles</span>
                </a>
            </li>
            <li>
                <a href="invoices.php">
                    <i class='fa fa-book'></i>
                    <span class="links_name">Invoices</span>
                </a>
            </li>
            <li>
                <a href="employees.php">
                    <i class='fa fa-users'></i>
                    <span class="links_name">Team</span>
                </a>
            </li>
            <!-- <li>
                <a href="#">
                    <i class='fa fa-message'></i>
                    <span class="links_name">Messages</span>
                </a>
            </li> -->
            <li class="log_out">
                <a href="../Assets/logout.php">
                    <i class='fa fa-arrow-right-from-bracket'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="profile-details">
                <img src="../Assets/Images/avatar.png">
                <span class="admin_name"><?php echo $row["username"]; ?></span>
            </div>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Vehicles In</div>
                        <div class="number"><?php echo $vec["vecs"]; ?></div>
                    </div>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Vehicles Fixed</div>
                        <div class="number"><?php echo $fix["fixed"]; ?></div>
                    </div>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Vehicles Being Fixed</div>
                        <div class="number"><?php echo $work["wor"]; ?></div>
                    </div>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Employees</div>
                        <div class="number"><?php echo $emp["empl"]; ?></div>
                    </div>
                </div>
            </div>

            <div class="sales-boxes">
                <div class="recent-sales box">
                    <div class="title">Vehicles Gone</div>
                    <div class="number"><?php echo $left["gone"]; ?></div>
                    <div class="sales-details">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Vehicle plate</th>
                                    <th>Owner</th>
                                    <th>Payment</th>
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
                                </tr>
                            <?php
                                    }
                            ?>
                            </tr>
                            </tbody>
                        </table>
                    </div><br>
                    <div class="button">
                        <a href="vehiclesGone.php">See All</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>
</body>

</html>