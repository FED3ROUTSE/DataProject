<?php 
include 'connect.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Product</title>
    <style>
        .container {
            margin: 35px;
            text-align: center;
            background-color: #f2f2f2; /* Light gray background */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Add padding */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */
            margin-bottom: 60px;
            margin-top: 50px;
            max-width: 240px; /* Adjust this value as needed */
            min-height: 320px;
            max-height: 320px;
            word-wrap: break-word;
            transition: transform 0.3s ease, background-color 0.3s ease; /* Smooth hover effects */
        }

        .container h5 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .container img {
            width: 200px; /* Set image width */
            height: 200px; /* Set image height */
            border-radius: 10px; /* Rounded corners for images */
            margin-bottom: 10px; /* Add spacing between images and text */
        }

        .container:hover {
            box-shadow: 5px 10px 12px rgba(0, 0, 0, 0.5);
            background-color: #cccaca;
            transform: scale(1.05); /* Slightly enlarge the container on hover */
        }

        .boxes {
            display: flex;
            flex-direction: row;
            align-items: center; /* Align items vertically center */
            justify-content: center; /* Center items horizontally */
            flex-wrap: wrap; /* Wrap items on smaller screens */
            gap: 20px; /* Space between items */
        }

        .arrow {
            font-size: 50px; /* Set arrow size */
            margin-left: 20px; /* Space between arrow and container */
        }

        .container1 {
            margin: 35px;
            text-align: center;
            background-color: #f2f2f2; /* Light gray background */
            border-radius: 10px; /* Rounded corners */
            padding: 20px; /* Add padding */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Box shadow */
            margin-bottom: 60px;
            margin-top: 50px;
            min-width: 240px;
            max-width: 240px; /* Adjust this value as needed */
            min-height: 320px;
            max-height: 320px;
            word-wrap:break-word;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease, background-color 0.3s ease; /* Smooth hover effects */
        }

        .container1:hover {
            box-shadow: 5px 10px 12px rgba(0, 0, 0, 0.5);
            background-color: #cccaca;
            transform: scale(1.05); /* Slightly enlarge the container on hover */
        }

        .container1 input {
            margin: 5px;
            padding: 5px;
            width: 80%; /* Adjust input width */
            background-color: #fff; /* White background for inputs */
            border: 1px solid #ccc; /* Border for inputs */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Box shadow */
            transition: box-shadow 0.3s ease, border-color 0.3s ease; /* Smooth focus effects */
        }

        .container1 input:focus {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2); /* Enhance box shadow on focus */
            border-color: #4CAF50; /* Change border color on focus */
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

        .container, .container1 {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; margin-top: 30px;">Modify Product</h1>
    <div class="boxes">
        <div class="container">
            <?php
            if (isset($_GET['product'])) {
                // Retrieve and decode the product name from the URL
                $productName = urldecode($_GET['product']);
                
                // Fetch additional product details from the database based on the product name
                $sql = "SELECT * FROM products WHERE name = '$productName'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // Product details found, fetch and display them
                    $row = $result->fetch_assoc();
                }
            }
            
            if (!empty($row['img'])) {
                // Decode the base64-encoded image data
                $image_data = base64_decode($row['img']);
                // Output the image
                echo "<img src='data:image/png;base64," . base64_encode($image_data) . "'>";
            }
            ?>
            <h3><?php echo $row['name']; ?></h3>
            <h5><?php echo $row['brand'] . ', ' . $row['color'] . ', ' . $row['category']; ?></h5>
            <h5>£<?php echo $row['price']; ?></h5>
        </div>
        <i class="fa fa-long-arrow-alt-right arrow"></i>
        <div class="container1">
            <form method="POST" enctype="multipart/form-data">
                <input type="file" id="img" name="img" accept="image/*">
                <input type="text" id="name" name="name" placeholder="Modify name...">
                <input type="text" id="brand" name="brand" placeholder="Modify brand...">
                <input type="text" id="color" name="color" placeholder="Modify color...">
                <input type="text" id="category" name="category" placeholder="Modify category...">
                <input type="number" id="price" name="price" min="0" step="0.10" placeholder="Modify price...">
                <input type="submit" name="submit" value="Update Product">
            </form>
        </div>
    </div>    

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Initialize an array to hold the update parts
        $updateParts = [];

        // Check and append the update parts for each field if provided
        if (!empty($_POST['name'])) {
            $newName = $_POST['name'];
            $updateParts[] = "name = '$newName'";
        }
        if (!empty($_POST['brand'])) {
            $newBrand = $_POST['brand'];
            $updateParts[] = "brand = '$newBrand'";
        }
        if (!empty($_POST['color'])) {
            $newColor = $_POST['color'];
            $updateParts[] = "color = '$newColor'";
        }
        if (!empty($_POST['category'])) {
            $newCategory = $_POST['category'];
            $updateParts[] = "category = '$newCategory'";
        }
        if (!empty($_POST['price'])) {
            $newPrice = $_POST['price'];
            $updateParts[] = "price = '$newPrice'";
        }

        // Handle image upload if a new image is uploaded
        if (!empty($_FILES['img']['tmp_name'])) {
            $image = $_FILES['img']['tmp_name'];
            $imgData = base64_encode(file_get_contents($image));
            $updateParts[] = "img = '$imgData'";
        }

        // Only proceed if there are update parts
        if (!empty($updateParts)) {
            $updateSql = "UPDATE products SET " . implode(', ', $updateParts) . " WHERE name = '$productName'";
            
            if ($conn->query($updateSql) === TRUE) {
                header('Location: home.php');
            exit();
                
            } else {
                echo "<p style='text-align: center; color: red;'>Error updating product: " . $conn->error . "</p>";
            }
        }
    }
    ?>

</body>
</html>
