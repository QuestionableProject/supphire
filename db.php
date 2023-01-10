<?php
  session_start();
$db = new PDO(
    "mysql:host=localhost;dbname=test;charset=utf8", "root",''
);

if (!isset($_SESSION["user"])) {
    $_SESSION["user"] = [];
}
