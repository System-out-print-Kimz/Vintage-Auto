<?php
require 'db.php';
if (!empty($_SESSION["id"])) {
    session_destroy();
    header("Location: ../index.php");
}
?>