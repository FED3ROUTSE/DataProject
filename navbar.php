<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <!-- Include CSS styles here -->
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    width: 100%;
    height: 100%;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(''); /* Replace 'path_to_your_image.jpg' with the actual path to your image */
    background-size: cover; /* Cover the entire viewport */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat;
}
header {
    background-color: #333;
    color: #fff;
    text-align: center;
    width: 100%;
    display: flex; /* Use flexbox for layout */
    justify-content: space-between; /* Align items to both ends of the container */
    padding: 10px 20px; /* Adjust padding for better spacing */
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex; /* Use flexbox for layout */
}

nav ul li {
    margin-right: 10px; /* Add spacing between menu items */
}

nav ul li:last-child {
    margin-right: 0; /* Remove margin from the last menu item */
}

nav ul li a {
    margin: 5px;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px; /* Increase padding to make the navbar bigger */
    display: inline-block; /* Make menu items block-level elements */
}

nav ul li a:hover {
    background-color: #111;
}
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}

header h1{
    float: left;
    margin: 5px;
}
footer p{
    padding:20px 30px;
}

     

 .burger {
    display: none; /* Hide burger icon by default */
    flex-direction: column;
    cursor: pointer;
    padding: 10px;
    margin-left: auto;
}

a{
    text-decoration:none;
    color: black;
}


.line {
    width: 25px;
    height: 3px;
    background-color: #fff;
    margin: 3px;
}

.header-content {
    display: flex;
    align-items: center;
}


/* Adjust margin for burger icon */


        @media only screen and (max-width: 768px) {
            .header-content {
        flex-direction: row; /* Ensure horizontal alignment */
        justify-content: space-between; /* Align items to the start and end of the container */
    }
            .burger {
                float: left;
        display: flex; /* Show burger icon on smaller screens */
    }
    header {
        flex-direction: column; /* Change flex direction to column for smaller screens */
        
    }


    nav {
       display: none;
    }

    #nav-links.active {
    display: block;
}

    nav ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    nav ul li {
        text-align: center;
        padding: 10px 0;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
    }


}



    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
    <div class="header-content">
        <h1>Data Project</h1>
        <div class="burger" onclick="toggleMenu()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>
        <nav id = "nav-links">
            <ul>
                <li><a href="insert_data.php">Insert Data</a></li>
                <li><a href="home.php">Data</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>
    

    <footer>
        <p>&copy; 2024 Data Project. All rights reserved.</p>
    </footer>

    <script>
        function toggleMenu() {
            var nav = document.getElementById("nav-links");
            nav.classList.toggle("active");
        }


    </script>
</body>
</html>
