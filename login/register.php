<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../includes/ess/head.php" ?>
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <script src="public/js/register.js" defer></script>
    <title>Register - LABSCHOOL</title>
</head>

<body>
    <header>
        <div class="app-container">
            <div class="app">
                <form id="login-form" action="includes/logic/register-logic.php" class="app-form">
                    <h1 class="login-h">Register</h1>
                    <div class="input-container">
                        <input class="input" type="text" id="fullname" name="fullname" placeholder="Full name"
                            required><br>
                    </div>
                    <div class="input-container">
                        <input class="input" type="text" id="kelas" name="kelas" placeholder="kelas (E.g. 11-2)"
                            required><br>
                    </div>
                    <div class="input-container">
                        <input class="input" type="text" id="username" name="username" placeholder="Username"
                            required><br>
                    </div>
                    <div class="input-container">
                        <input class="input" type="password" id="password" name="password" placeholder="Password"
                            required><br>
                    </div>
                    <div class="forget-password">
                        <a class="register" href="login.php">Already have account?</a>
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