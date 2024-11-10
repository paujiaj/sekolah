<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/forget-password.css">
    <script src="public/js/pass-reset.js" defer></script>
    <title>Forget Password - LABSCHOOL</title>
</head>

<body>
    <header>
        <div class="app-container">
            <div class="app">
                <form id="login-form" action="includes/logic/pass-reset.php" class="app-form">
                    <h1 class="login-h">Reset Password</h1>
                    <div class="input-container">
                        <input class="input" type="text" id="username" name="username" placeholder="Username/Fullname"
                            required><br>
                    </div>
                    <div class="input-container">
                        <input class="input" type="text" id="kelas" name="kelas" placeholder="kelas (E.g. 11-2)"
                            required><br>
                    </div>
                    <div class="input-container">
                        <input class="input" type="password" id="password" name="password" placeholder="Password"
                            required><br>
                    </div>

                    <div class="forget-password">
                        <a class="register" href="login.php">Already have account?</a>
                        <a class="register" href="register.php">New here?</a>
                    </div>

                    <input class="login-btn" type="submit" value="Reset and login"></input>
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