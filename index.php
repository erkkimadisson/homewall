<?php
    include_once "./essentials.php";
    $database = new Database();
    $conn = $database->getConnection();

    if(!isset($_SESSION["user_id"])) {
        header("Location: ./login.php");
    }

    
?>



<body class="w-screen bg-gray-900">
    <div class="w-screen">
        <div class="grid  grid-cols-3 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-12">
            <div class="h-screen bg-gray-800 sm:col-span-3 md:col-span-2 lg:col-span-3">
                <?php include_once "./nav.php"?>
            </div>
            <div class="col-span-2 sm:col-span-3 md:col-span-4 lg:col-span-9 flex gap-3 flex-col">
                <div class="flex flex-row h-5 m-3">
                    <div class="flex flex-evenly flex-row breadcrumbs">
                        <a href="?page=dashboard"><i class="w-5 h-5 fa-solid fa-house text-gray-100 "></i></a>
                    </div>
                    <div class="flex flex-evenly flex-row buttons">
                        <a href=""></a><a href=""></a><a href=""></a>
                    </div>
                </div>
                <div class="flex h-full">
                    content
                </div>
            </div>
        </div>
    </div>
    <div class="absolute right-0 bottom-0 text-gray-800 m-2">
        <?= $version ?>
    </div>
</body>

</html>
<?php
// if (!isset($_GET['page']) || $_GET['page'] == "dashboard") {
//     $page = "dashboard";
//     // Do something with the $page variable, such as:
//     echo "The page parameter is: " . $page;
// } else {
//     // Handle the case where the 'page' parameter is not set
//     echo "The page parameter is not set.";
// }
?>
<?php
$database->closeConnection();



