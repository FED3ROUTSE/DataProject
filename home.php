<?php 
include 'connect.php';

$sql = "SELECT * FROM products";
$result_products = $conn->query($sql);

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    // Perform deletion query
    mysqli_query($conn, "DELETE FROM `products` WHERE id = $remove_id");
    // Redirect to the same page after deletion
    header('Location: home.php');
    exit(); // Stop further execution
}

if(isset($_GET['hi-lo'])){
    // Fetch products sorted by price in ascending order
    $sql = "SELECT * FROM products ORDER BY price ASC";
    $result_products = $conn->query($sql);
} elseif(isset($_GET['lo-hi'])) {
    // Fetch products sorted by price in descending order
    $sql = "SELECT * FROM products ORDER BY price DESC";
    $result_products = $conn->query($sql);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <!-- Include CSS styles here -->
    <style>
        /* Your existing styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(''); /* Replace with the actual path to your image */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
header {
    background-color: #333;
    color: #fff;
    text-align: center;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
}
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
}
nav ul li {
    margin-right: 10px;
}
nav ul li:last-child {
    margin-right: 0;
}
nav ul li a {
    margin: 5px;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    display: inline-block;
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
header h1 {
    float: left;
    margin: 5px;
}
footer p {
    padding: 20px 30px;
}
.container {
    float: left;
    margin: 35px;
    text-align: center;
    background-color: #f2f2f2;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 60px;
    margin-top: 50px;
    overflow: hidden;
    max-width: 240px; /* Adjust this value as needed */
    min-width: 240px;
    min-height: 350px;
    max-height: 350px;
    word-wrap: break-word; /* Ensure long words break */
    transition: transform 0.3s ease, background-color 0.3s ease; /* Smooth hover effects */
}
.container h5 {
    margin-top: 5px;
    margin-bottom: 5px;
    word-wrap: break-word; /* Ensure long words break */
}
.center-heading {
    text-align: center;
    margin-top: 30px;
}
.container img {
    width: 200px;
    height: 200px;
    border-radius: 10px;
    margin-bottom: 10px;
}
.container:hover {
    box-shadow: 5px 10px 12px rgba(0, 0, 0, 0.5);
    background-color: #cccaca;
    transform: scale(1.05); /* Slightly enlarge the container on hover */
}
.burger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    padding: 10px;
    margin-left: auto;
}
a {
    text-decoration: none;
    color: black;
}
.message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid #c3e6cb;
    border-radius: 5px;
    text-align: center;
    max-width: 400px;
    margin: 10px auto;
    font-size: 14px;
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
.delete_btn {
    text-decoration: none;
}
@media only screen and (max-width: 768px) {
    .header-content {
        flex-direction: row;
        justify-content: space-between;
    }
    .burger {
        float: left;
        display: flex;
    }
    header {
        flex-direction: column;
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
    .container {
        width: calc(100% - 60px);
        margin-right: 20px;
    }
}
.box {
    float: right;
    margin-top: -5px;
}
.all {
    margin-top: 30px;
}
.box {
    margin-top: 10px;
    margin-right: 60px;
}
.box label {
    font-weight: bold;
}
#sort {
    border-radius: 20px;
}

@keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container{
            animation: fadeIn 0.5s ease;
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
    <div class = "sorting">
        
    <h1 class = "center-heading">Data Display</h1>
    <div class = "box">   
    <label for="sort">Sort By:</label>
    <select id="sort">
      <option value="select">Select </option>  
      <option id = "hi-lo" value="hi-lo">Price (Low - High) </option>
      <option id = "lo-hi" value="lo-hi">Price (High - Low) </option>
    </select>
</div>
    </div>
    <?php 
    if ($result_products -> num_rows >0){
        while ($row = $result_products ->fetch_assoc()){
            ?>
            <div class = "all">
            <a href ="product-view.php?product=<?=urlencode($row['name']);?>">
            <div class="container">
                <?php
                // Ensure that 'img' field is not empty
                if (!empty($row['img'])) {
                    // Decode the base64-encoded image data
                    $image_data = base64_decode($row['img']);
                    // Output the image
                    echo "<img src='data:image/png;base64," . base64_encode($image_data) . "' width='200' height='200'>";
                } else {
                    // If image data is empty, show a placeholder image or alternative text
                    echo "<p>No image available</p>";
                }
                ?>
                <h3><?php echo $row['name']; ?></h3>
                <h5><?php echo $row['brand'] . ', ' .$row['color'] . ', ' . $row['category']; ?></h5>
                <h5>£<?php echo $row['price']; ?></h5>
                <a style = "color: black;"href="home.php?remove=<?php echo $row['id']; ?>" class="delete_btn" onclick="return confirm('Are you sure you want to delete this item?');">
                <i class="fa fa-trash"></i>  Delete
                </a>
                <a style="color: black;" href="modify.php?product=<?=urlencode($row['name']); ?>" class="modify_btn">
                <i class="fas fa-edit"></i> Modify
                </a>



            </div>
            </a>
            </div>
            <?php
        }
    } else {
        echo "No products found.";
    }
    ?>
    

    <footer>
        <p>&copy; 2024 Data Project. All rights reserved.</p>
    </footer>

    <script>
        function toggleMenu() {
            var nav = document.getElementById("nav-links");
            nav.classList.toggle("active");
        }

        function handleSort() {
        // Get the selected value from the sort dropdown
        var selectedValue = document.getElementById("sort").value;
        
        // Redirect the user based on the selected sorting option
        if (selectedValue === "hi-lo") {
            window.location.href = "home.php?hi-lo";
        } else if (selectedValue === "lo-hi") {
            window.location.href = "home.php?lo-hi";
        }
    }

    // Add event listener to the sort dropdown
    document.getElementById("sort").addEventListener("change", handleSort);

    </script>
</body>
</html>
