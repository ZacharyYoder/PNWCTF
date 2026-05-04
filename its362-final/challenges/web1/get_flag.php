<?php
session_start();

// Only logged-in users can request the flag
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}

// The real flag — never exposed in HTML or JS
$flag = "PNW{cmV2ZXJzZV94c3NfY29tcGxldGU=}";

echo $flag;

?>