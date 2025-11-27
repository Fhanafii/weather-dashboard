<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Weather Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleForm() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const title = document.getElementById('form-title');
            const toggleText = document.getElementById('toggle-text');
            const toggleLink = document.getElementById('toggle-link');

            if (loginForm.classList.contains('hidden')) {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                title.textContent = 'Login to Weather Dashboard';
                toggleText.textContent = "Don't have an account? ";
                toggleLink.textContent = 'Register here';
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                title.textContent = 'Daftar akun Cerahin untuk akses';
                toggleText.textContent = 'Already have an account? ';
                toggleLink.textContent = 'Login here';
            }
        }
    </script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex items-center justify-center mb-4">
            <img src="assets/icons/logo.svg" alt="Logo" class="w-13 h-13 object-contain">
        </div>

        <h2 id="form-title" class="text-2xl font-bold mb-6 text-center" style="color: #F9802C;">Masuk Ke Cerahin dashboard</h2>

        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                Invalid username or password.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == 2): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                Username already exists.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                Registration successful! Please login.
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <div id="login-form">
            <form action="/auth.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" name="login"
                            class="bg-[#F9802C] text-white w-full font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div id="register-form" class="hidden">
            <form action="/auth.php" method="POST">
                <div class="mb-4">
                    <label for="reg_username" class="block text-gray-800 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="reg_username" name="username" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="reg_password" class="block text-gray-800 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="reg_password" name="password" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" name="register"
                            class="bg-[#F9802C] text-white font-bold py-2 px-4 w-full rounded focus:outline-none focus:shadow-outline">
                        Register
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 text-center">
            <span id="toggle-text">Don't have an account? </span>
            <a href="#" id="toggle-link" onclick="toggleForm()" class="text-[#F9802C]">Register here</a>
        </div>
    </div>
</body>
</html>
