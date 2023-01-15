<?php
require '../Assets/db.php';
if (!empty($_SESSION["id"])) {
    require "../invlib/invoicr.php";
    $inv_number = $_SESSION["invoice"];
    $inv_to = $_SESSION["name"];
    $inv_to_contact = $_SESSION["address"];
    $pay_for = $_SESSION["service"];
    $pay_amt = $_SESSION["amount"];

    // (B2) INVOICE HEADER
    $invoicr->set("head", [
        ["Invoice", $inv_number],
        ["DOP", date("d-m-Y")]
    ]);

    // (B3) BILL TO
    $invoicr->set("billto", [
        $inv_to,
        $inv_to_contact
    ]);

    // (B4) SHIP TO
    // $invoicr->set("shipto", [
    //     "Customer Name",
    //     "Street Address",
    //     "City, State, Zip"
    // ]);

    // (B5) ITEMS - ADD ONE-BY-ONE
    $items = [
        [$pay_for, "", "", "", $pay_amt]
    ];
    // foreach ($items as $i) { $invoicr->add("items", $i); }

    // (B6) ITEMS - OR SET ALL AT ONCE
    $invoicr->set("items", $items);

    // (B7) TOTALS
    // $invoicr->set("totals", []);

    // (B8) NOTES, IF ANY
    $invoicr->set("notes", [
        "Payment should be in M-pesa or cheque",
        "",
        "Come back again"
    ]);

    // (C) OUTPUT
    // (C1) CHOOSE A TEMPLATE
    // $invoicr->template("apple");
    // $invoicr->template("banana");
    // $invoicr->template("blueberry");
    // $invoicr->template("lime");
    $invoicr->template("simple");
    // $invoicr->template("strawberry");

    // (C2) OUTPUT IN HTML
    // DEFAULT : DISPLAY IN BROWSER
    // 1 : DISPLAY IN BROWSER
    // 2 : FORCE DOWNLOAD
    // 3 : SAVE ON SERVER
    // $invoicr->outputHTML();
    // $invoicr->outputHTML(1);
    // $invoicr->outputHTML(2, "invoice.html");
    // $invoicr->outputHTML(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.html");

    // (C3) OUTPUT IN PDF
    // DEFAULT : DISPLAY IN BROWSER
    // 1 : DISPLAY IN BROWSER
    // 2 : FORCE DOWNLOAD
    // 3 : SAVE ON SERVER
    $invoicr->outputPDF();
    // $invoicr->outputPDF(1);
    // $invoicr->outputPDF(2, "invoice.pdf");
    // $invoicr->outputPDF(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.pdf");

    // (C4) OUTPUT IN DOCX
    // DEFAULT : FORCE DOWNLOAD
    // 1 : FORCE DOWNLOAD
    // 2 : SAVE ON SERVER
    // $invoicr->outputDOCX();
    // $invoicr->outputDOCX(1, "invoice.docx");
    // $invoicr->outputDOCX(2, __DIR__ . DIRECTORY_SEPARATOR . "invoice.docx");

    // (D) USE RESET() IF YOU WANT TO CREATE ANOTHER ONE AFFTER THIS
    // $invoicr->reset();
} else {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Assets/Images/icon.png">
    <title>Vinatage Auto</title>
</head>

<body>
    <div class="all-content">
        <p></p>
    </div>
</body>

</html>