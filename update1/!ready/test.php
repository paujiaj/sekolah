<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu</title>
    <link rel="stylesheet" href="styles.css">
</head>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Toggle the dropdown menu when clicking on the parent dropdown
        document.querySelector('.dropdown > a').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default action of the dropdown link itself
            var dropdownMenu = this.nextElementSibling; // Get the next sibling which is the dropdown-menu
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        });

        // Allow clicking on links inside the dropdown menu
        document.querySelectorAll('.dropdown-menu a').forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent the dropdown from toggling when clicking a link
            });
        });
    });
</script>
<style>
    /* Basic Styles */
    body {
        font-family: Arial, sans-serif;
    }

    .nav {
        list-style-type: none;
        margin: 0;
        padding: 0;
        background-color: #333;
        position: sticky;
    }

    .nav li {
        display: inline-block;
        position: relative;
    }

    .nav li a {
        display: block;
        padding: 14px 20px;
        text-decoration: none;
        color: white;
    }

    .nav li a:hover {
        background-color: #575757;
    }

    /* Dropdown Menu Styles */
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #333;
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .dropdown-menu li a {
        padding: 10px 20px;
        display: block;
        text-decoration: none;
        color: white;
    }

    .dropdown-menu li a:hover {
        background-color: #575757;
    }
</style>

<body>
    <ul class="nav">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li class="dropdown">
            <a href="#">Subjects ▼</a>
            <ul class="dropdown-menu">
                <li><a href="youtube.com">Math</a></li>
                <li><a href="#">Science</a></li>
                <li><a href="#">History</a></li>
                <li><a href="#">Art</a></li>
            </ul>
        </li>
        <li><a href="#">Contact</a></li>
    </ul>
</body>

</html>