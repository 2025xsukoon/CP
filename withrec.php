<?php
// Define database credentials
$servername = "localhost";
$username = "hari123";
$password = "hari123";
$dbname = "hari123";

// Create PDO object and connect to database
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Define SQL statements
$sqlStatements = [
  "TRUNCATE TABLE `beconebetrec`",
  "TRUNCATE TABLE `beconebetting`",
  "TRUNCATE TABLE `betrec`",
  "TRUNCATE TABLE `betting`",
  "TRUNCATE TABLE `emredbetrec`",
  "TRUNCATE TABLE `emredbetting`",
  "TRUNCATE TABLE `giftrec`",
  "TRUNCATE TABLE `saprebetrec`",
  "TRUNCATE TABLE `saprebetting`",
  "TRUNCATE TABLE `verify`",
  "TRUNCATE TABLE `vipbetrec`",
  "TRUNCATE TABLE `vipbetting`"
];

// Execute SQL statements
foreach ($sqlStatements as $sql) {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
    header("location: delete");
}
?>
