<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination = $_POST["destination"];
    $depart_date = $_POST["depart_date"];
    $return_date = $_POST["return_date"];
    $duration = $_POST["duration"];

    echo "Destination: " . $destination . "<br>";
    echo "Depart Date: " . $depart_date . "<br>";
    echo "Return Date: " . $return_date . "<br>";
    echo "Duration: " . $duration . "<br>";
}
