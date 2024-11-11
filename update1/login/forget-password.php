<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/forget-password.css">
    <script src="public/js/pass-reset.js" defer></script>
    <title>Forget Password - LABSCHOOL</title>
</head>

<body>
    <section class="fullPage">
        <div class="app">
            <div class="title">
                <h1>Reset password</h1>
            </div>
            <div class="form">
                <form id="loginForm" action="includes/logic/pass-reset.php" class="app-form">
                    <input class="input" type="text" id="username" name="username" placeholder="Username/Fullname"
                        required>
                    <input class="input" type="text" id="kelas" name="kelas" placeholder="kelas (E.g. 11-2)"
                        required>
                    <input class="input" type="password" id="password" name="password" placeholder="Password"
                        required>
                    <div class="formFooter">
                        <div class="checkBox">
                            <input type="checkbox" id="rememberMe" name="rememberMe"> Remember Me
                        </div>
                    </div>

                    <input class="login-btn" type="submit" value="Reset and login"></input>
                </form>
            </div>
            <div class="error-msg" id="error-popup" style="display: none;">
                <p id="error-msg-p">
                    Username or password incorrect
                </p>
            </div>
            <div class="footer">
                <p>Remember your password? &nbsp;</p><a href="login.php">Sign-in</a>
            </div>
        </div>
    </section>
</body>

</html>