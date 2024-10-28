<?php
include_once "./essentials.php";
$database = new Database();
$conn = $database->getConnection();
if (!isset($_GET["action"]) || $_GET["action"] == "login") {
    $action = "Login";
} elseif ($_GET["action"] == "register") {
    $action = "Register";
}

?>
<body class="w-screen bg-gray-900 flex h-screen justify-center items-center">
    <div class="bg-red-100 h-auto rounded p-3 flex flex-col justify-center items-center g-2 ">
        <h1 class="text-4xl font-bold">
            HomeWall
        </h1>
        <h2 class="text-2xl font-bold">
            <?= $action?>
        </h2>
        <form method="post" class="flex flex-col justify-center items-center">
            <input type="email" name="email" id="email" placeholder="Email" >
            <?php if ($action == "Login"): ?>
            <?php elseif ($action == "Register"): ?>

            <?php endif; ?>
        </form>
    </div>
</body>
</html>