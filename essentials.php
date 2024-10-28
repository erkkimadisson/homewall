<?php
    require_once(__DIR__ . "/database/database.php");
    session_start();
$version = "0.2.5";
if (!isset($title)) {
    $title = 'HomeWall - ' . $version;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/98a9f8b1f8.js" crossorigin="anonymous"></script>
    <script src="./public/js/nav.js" defer></script>

    <link rel="stylesheet" href="./public/css/main.css">
    <title><?= $title ?></title>
</head>