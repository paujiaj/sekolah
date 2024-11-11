<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <script src="public/js/login.js" defer></script>
    <title>Sign-in - LABSCHOOL</title>
</head>

<body>
    <section class="fullPage">
        <div class="app">
            <div class="title">
                <h1>Sign-in</h1>
            </div>
            <div class="form">
                <form id="loginForm" action="includes/logic/login-logic.php" class="app-form">
                    <label for="username">Nama</label>
                    <input class="input" type="text" id="username" name="username" placeholder="Masukan username/nama lengkap"
                        required><br>
                    <label for="password">Password</label>
                    <input class="input" type="password" id="password" name="password" placeholder="Masukan password"
                        required><br>
                    <div class="formFooter">
                        <div class="checkBox">
                            <input type="checkbox" id="rememberMe" name="rememberMe"> Remember Me
                        </div>
                        <a href="forget-password.php">Forget Password?</a>
                    </div>
                    <input class="login-btn" type="submit" value="Login"></input>
                </form>
            </div>
            <div class="error-msg" id="error-popup" style="display: none;">
                <p id="error-msg-p">
                    Username or password incorrect
                </p>
            </div>
            <div class="footer">
                <p>Don't have an account? &nbsp;</p><a href="register.php">Sign-up</a>
            </div>
        </div>
    </section>

</body>

</html>