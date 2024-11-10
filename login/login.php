<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script src="public/js/login.js" defer></script>
    <title>Login - LABSCHOOL</title>
</head>

<body>
    <header>
        <div class="app-container">
            <div class="app">
                <form id="login-form" action="includes/logic/login-logic.php" class="app-form">
                    <h1 class="login-h">Login</h1>
                    <div class="input-container">
                        <input class="input" type="text" id="username" name="username" placeholder="Username/Fullname"
                            required><br>
                    </div>
                    <div class="input-container">
                        <input class="input" type="password" id="password" name="password" placeholder="Password"
                            required><br>
                    </div>
                    <div class="forget-password">
                        <a class="forget-password-a" href="forget-password.php">Forget password?</a>
                        <a class="register" href="register.php">New here?</a>
                    </div>

                    <input class="login-btn" type="submit" value="Login"></input>
                </form>
                <div class="error-msg" id="error-popup" style="display: none;">
                    <p id="error-msg-p">
                        Username or password incorrect
                    </p>
                </div>
            </div>
        </div>
    </header>

</body>

</html>