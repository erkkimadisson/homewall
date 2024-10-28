<?php
include_once "./essentials.php";

if (!isset($_GET["action"]) || $_GET["action"] == "login") {
    $action = "Login";
    $actionPath = "./api/Login.php";
} elseif ($_GET["action"] == "register") {
    $action = "Register";
    $actionPath = "./api/Register.php";
}

?>
<body class="w-screen bg-gray-900 flex h-screen justify-center items-center">
    <div class="bg-red-100 h-auto rounded p-3 flex flex-col justify-center items-center gap-2 ">
        <?php if (!empty($msg)): ?>
            <div class="error"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>
        <h1 class="text-4xl font-bold">
            HomeWall
        </h1>
        <h2 class="text-2xl font-bold">
            <?= $action?>
        </h2>
        <form id="Form" action="<?php echo htmlspecialchars($actionPath); ?>" method="post" class="flex flex-col gap-2 justify-center items-center w-96">
            <input type="email" name="email" id="email" placeholder="Email" class="px-3 py-1 rounded w-96" required>
            <?php if ($action == "Login"): ?>
                <input type="password" name="password" id="password" placeholder="Password" class="px-3 py-1 rounded w-96" required>
            <?php elseif ($action == "Register"): ?>
                <input type="text" name="first" id="first" placeholder="First Name" class="px-3 py-1 rounded w-96" required>
                <input type="text" name="last" id="last" placeholder="Last Name" class="px-3 py-1 rounded w-96" required>
                <input type="password" name="password" id="password" placeholder="Password" class="px-3 py-1 rounded w-96" required>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="px-3 py-1 rounded w-96" required>
                
            <?php endif; ?>
            <input type="submit" value="submit">
        </form>
        <div id="error-container" class="error"></div>
    </div>
</body>

<script>
document.getElementById('Form').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent default form submission

    const form = this;
    const formData = new FormData(form);
    
    const errorContainer = document.getElementById('error-container');
    const actionPath = form.action.split("/").slice(-1)[0];
    console.log("action", form.action);
    console.log("path",actionPath);

    
    if (actionPath == "Register.php") {
        const response = await fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(async response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return await response.text();
     // Assuming the server returns a plain text error message
        })
        .then(data => {
            if (data) {
                errorContainer.textContent = data;
            } else {
                // Registration successful
                errorContainer.textContent = 'Registration successful!';
                // Optionally redirect after a delay
                setTimeout(() => {
                    window.location.href = '?action=login';
                }, 1000); // Redirect after 1 second
            }
        })
        .catch(error => {
            console.error('Error during registration:', error);
            errorContainer.textContent = 'An error occurred during registration.';
        });
    } else {
        console.log("login");
        
        const response = await fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(async response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return await response.text();
     // Assuming the server returns a plain text error message
        })
        .then(data => {
            if (data) {
                errorContainer.textContent = data;
            } else {
                // Registration successful
                errorContainer.textContent = 'Login successful!';
                // Optionally redirect after a delay
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 1000); // Redirect after 1 second
            }
        })
        .catch(error => {
            console.error('Error during login:', error);
            errorContainer.textContent = 'An error occurred during login.';
        });
    }

    
});
</script>
</html>