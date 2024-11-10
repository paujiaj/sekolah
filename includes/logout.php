<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - LABSCHOOL</title>
</head>

<body>
    <form method="post" action="includes/logic/logout-logic.php">
        <button type="submit" name="logout" id="logout-btn">Logout</button>
    </form>
</body>

<script>
    document.getElementById('logout-btn').addEventListener('click', function() {
    // Remove specific items from localStorage
    localStorage.removeItem('loggedin');
    localStorage.removeItem('user_id');
    localStorage.removeItem('username');
    localStorage.removeItem('kelas');
    localStorage.removeItem('fullname');
    localStorage.removeItem('url');
    
    // Optionally, clear all localStorage items
    // localStorage.clear();

    console.log('User logged out, localStorage cleared.');

    // Redirect to the login page or another location
    window.location.href = 'login.php'; // Change this to the appropriate page
});
</script>

</html>