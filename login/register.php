<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <script src="public/js/register.js" defer></script>
    <title>Register - LABSCHOOL</title>
</head>

<body>
    <section class="fullPage">
        <div class="app">
            <div class="title">
                <h1>Register</h1>
            </div>
            <div class="form">
                <form id="loginForm" action="includes/logic/register-logic.php" class="app-form">
                    <label for="fullname">Nama lengkap</label>
                    <input class="input" type="text" id="fullname" name="fullname" placeholder="Masukan nama lengkap"
                        required>
                    <label for="kelas">kelas</label>
                    <input class="input" type="text" id="kelas" name="kelas" placeholder="masukan kelas (contoh: 11-2)"
                        required>
                    <label for="kelas">username</label>
                    <input class="input" type="text" id="username" name="username" placeholder="masukan username"
                        required>
                    <label for="kelas">password</label>
                    <input class="input" type="password" id="password" name="password" placeholder="masukan password"
                        required>
                    <div class="formFooter">
                        <div class="checkBox">
                            <input type="checkbox" id="rememberMe" name="rememberMe"> Remember Me
                        </div>
                    </div>
                    <input class="login-btn" type="submit" value="Sign-up"></input>
                </form>
            </div>
            <div class="footer">
                <p>Already have an account? &nbsp;</p><a href="login.php">Sign-in</a>
            </div>
            <div class="error-msg" id="error-popup" style="display: none;">
                <p id="error-msg-p">
                    Username or password incorrect
                </p>
            </div>
        </div>
    </section>
</body>

</html>