<?php
    include_once "./essentials.php";
    $database = new Database();
    $conn = $database->getConnection();

    if(!isset($_SESSION["id"])) {
        header("Location: ./login.php");
    }

    
?>



<body class="w-screen bg-gray-900">
    <div class="w-screen">
        <div class="grid  grid-cols-3 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-12">
            <div class="h-screen bg-gray-800 sm:col-span-3 md:col-span-2 lg:col-span-3">
                <?php include_once "./nav.php"?>
            </div>
            <div class="col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-9 flex justify-center flex-col">

            </div>
        </div>
    </div>
    <div class="absolute right-0 bottom-0 text-gray-800 m-2">
        <?= $version ?>
    </div>
</body>

</html>