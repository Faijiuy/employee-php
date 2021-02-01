<?php
// $servername = "localhost";
// $username = "root";
// $password = "Fai1950237298";
// $dbname = "employees";


$url = parse_url(getenv("DATABASE_URL"));
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
$conn = new mysqli($server, $username, $password, $db);

echo "Extracted Info $servername $username $password $dbnane<br>";
?>