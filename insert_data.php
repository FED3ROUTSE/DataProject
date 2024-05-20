

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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* Set background image */
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

        .success-message {
            background-color: #d4edda; /* Green background color */
    color: #155724; /* Dark green text color */
    padding: 10px; /* Add padding */
    margin-top: 10px; /* Add margin at the top */
    border: 1px solid #c3e6cb; /* Add border */
    border-radius: 5px; /* Add border radius */
    text-align: center; /* Center align text */
    max-width: 400px; /* Limit maximum width */
    margin: 10px auto; /* Center horizontally */
    font-size: 14px; /* Adjust font size */
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

        .insert {
            text-align: center; /* Center the text */
            margin-top: 50px; /* Add some space above the heading */
        }

        .container-form {
            max-width: 400px; /* Set a maximum width for the container */
            margin: 50px auto; /* Center the container horizontally with auto margins */
            padding: 20px; /* Add padding to the container */
            text-align: center;
            background-color: #f2f2f2; /* Light gray background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */
        }
        
        .container-form label,
        .container-form input {
            display: block;
            margin: 0 auto; /* Center the elements horizontally */
            margin-bottom: 10px; /* Add space between elements */
        }

        .container-form input[type="text"],
        .container-form input[type="number"],
        .container-form input[type="file"],
        .container-form input[type="submit"] {
            width: calc(100% - 20px); /* Make inputs full width with margin */
            padding: 10px; /* Add padding */
            border: 1px solid #ccc; /* Add border */
            border-radius: 5px; /* Rounded corners */
        }

        .container-form input[type="submit"] {
            background-color: #333; /* Dark gray background */
            color: #fff; /* White text color */
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        .container-form input[type="submit"]:hover {
            background-color: #111; /* Darker gray on hover */
        }

        .burger {
    display: none; /* Hide burger icon by default */
    flex-direction: column;
    cursor: pointer;
    padding: 10px;
    margin-left: auto;
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

        @media screen and (max-width: 768px) {
            header {
                flex-direction: column; /* Change flex direction to column for smaller screens */
                align-items: center; /* Center align items */
            }

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

    /* Adjust styles for the active menu */
   
        
    </style>
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
        <nav id="nav-links">
            <ul>
                <li><a href="insert_data.php">Insert Data</a></li>
                <li><a href="home.php">Data</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </nav>
    </header>

    <h1 class="insert">Insert Data</h1>
    <?php
include 'connect.php';

if(isset($_POST['insert_item'])){
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $category = $_POST['category'];


    // Check if file is uploaded without errors
    if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        // Read image file data
        $img_data = file_get_contents($_FILES['img']['tmp_name']);

        // Encode image data as base64
        $img_base64 = base64_encode($img_data);
        
        // Insert data into database
        $stmt = $conn->prepare("INSERT INTO products (name, brand, price, img, category, color) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdsss", $name, $brand, $price, $img_base64, $category, $color);

        
        if ($stmt->execute()) {
            echo "<div class='success-message'>Data inserted successfully!</div>";
        } else {
            echo "Error inserting data: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error uploading image.";
    }
}
?>
    <div class="container-form">
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Input name:</label>
            <input type="text" id="name" name="name">
            <label for="brand">Input brand:</label>
            <input type="text" id="brand" name="brand">
            <label for="color">Input color:</label>
            <input type="text" id="color" name="color">
            <label for="category">Input category:</label>
            <input type="text" id="category" name="category">
            <label for="img">Select image:</label>
            <input type="file" id="img" name="img" accept="image/*">
            <label for="price">Input price:</label>
            <input type="number" id="price" name="price" min="0" step="0.10">
            <input type="submit" class="insert_item" name="insert_item" value="Insert Item">
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Data Project. All rights reserved.</p>
    </footer>

    <script>
        function toggleMenu() {
            var nav = document.querySelector("nav");
            nav.classList.toggle("active");
        }
    </script>
</body>
</html>
