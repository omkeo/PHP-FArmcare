<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "Task_TR");

$connect = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
