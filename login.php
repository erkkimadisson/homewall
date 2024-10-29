<?php
include_once "./essentials.php";

if (!isset($_GET["action"]) || $_GET["action"] == "login") {
    $action = "Login";
    $actionPath = "api/Login";
} elseif ($_GET["action"] == "register") {
    if ($_ENV["ALLOW_REGISTER"] == "true") {
        $action = "Register";
        $actionPath = "api/Register";
    } else {
        header("Location: login?action=login");
    }
}

?>

<body class="w-screen bg-gray-900 flex h-screen justify-center items-center">
    <div class="bg-gray-800 h-auto rounded p-5 flex flex-col justify-center items-center gap-5 ">
        <?php if (!empty($msg)): ?>
            <div class="error"><?php echo htmlspecialchars($msg); ?></div>
        <?php endif; ?>
        <div class="flex flex-col items-center justify-center font-bold text-gray-100">
            <h1 class="text-4xl">
                HomeWall
            </h1>
            <h2 class="text-2xl">
                <?= $action ?>
            </h2>
        </div>
        <form id="Form" action="<?php echo htmlspecialchars($actionPath); ?>" method="post"
            class="flex flex-col gap-3 justify-center items-center w-96 text-gray-100">
            <div class="flex flex-col w-4/5 ">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" class="px-3 py-1 rounded  bg-gray-50 text-gray-900 text-gray-900"
                    required>
            </div>
            <?php if ($action == "Login"): ?>
                <div class="flex flex-col w-4/5 ">
                <label for="password">Password:</label>

                    <input type="password" name="password" id="password" placeholder="Password"
                        class="px-3 py-1 rounded  bg-gray-50 text-gray-900" required>
                </div>
            <?php elseif ($action == "Register"): ?>
                <div class="flex flex-col w-4/5 ">
                <label for="first">First name:</label>

                    <input type="text" name="first" id="first" placeholder="First Name"
                        class="px-3 py-1 rounded  bg-gray-50 text-gray-900" required>
                </div>

                <div class="flex flex-col w-4/5 ">
                <label for="last">Last name:</label>

                    <input type="text" name="last" id="last" placeholder="Last Name" class="px-3 py-1 rounded  bg-gray-50 text-gray-900"
                        required>
                </div>

                <div class="flex flex-col w-4/5 ">
                <label for="password">Password:</label>
                    
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="px-3 py-1 rounded  bg-gray-50 text-gray-900" required>
                </div>
                <div class="flex flex-col w-4/5 ">
                <label for="confirm_password">Confirm password:</label>

                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password"
                        class="px-3 py-1 rounded  bg-gray-50 text-gray-900" required>
                </div>
            <?php endif; ?>
            <input type="submit" value="SUBMIT" class="w-4/5 bg-blue-700 rounded p-3 text-white">
        </form>
        <div id="error-container" class="error"></div>
    </div>
</body>

<script>
    document.getElementById('Form').addEventListener('submit', async function (event) {
        event.preventDefault(); // Prevent default form submission

        const form = this;
        const formData = new FormData(form);

        const errorContainer = document.getElementById('error-container');
        const actionPath = form.action.split("/").slice(-1)[0];
        console.log("action", form.action);
        console.log("path", actionPath);


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
                            window.location.href = 'index';
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