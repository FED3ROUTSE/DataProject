<?php
include 'connect.php'; // Include your database connection file
include 'navbar.php';

// Function to resize an image using GD
function resizeImage($image_data, $max_width, $max_height) {
    $image = imagecreatefromstring($image_data);
    if ($image === false) {
        return false;
    }

    $width = imagesx($image);
    $height = imagesy($image);

    // Calculate the scaling ratio
    $ratio = min($max_width / $width, $max_height / $height);

    // Calculate the new dimensions
    $new_width = (int)($width * $ratio);
    $new_height = (int)($height * $ratio);

    // Create a new true color image
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Copy and resize the old image into the new image
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // Capture the output
    ob_start();
    imagepng($new_image);
    $resized_image_data = ob_get_clean();

    // Free up memory
    imagedestroy($image);
    imagedestroy($new_image);

    return $resized_image_data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
            align-items: start;
            padding: 20px;
        }
        .imgcont {
            width: 80%;
            margin-bottom: 50px;
        }
        .imgcont img {
            width: 100%;
            height: auto;
            display: block;
        }
        .det {
            width: 20%;
            margin-left: 4%;
            display: block;
            align-items: center;
        }
        .all {
            font-size: 20px;
            font-weight: 100;
        }
        .price {
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
        hr {
            margin: 10px 0;
            border: 1px solid black;
        }
    </style>
</head>
<body>
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
            
            // Decode and resize the image
            $image_data = base64_decode($row['img']);
            $resized_image_data = resizeImage($image_data, 800, 800); // Example size

            if ($resized_image_data !== false) {
                $image_base64 = base64_encode($resized_image_data);
            } else {
                echo "Error resizing image.";
                $image_base64 = base64_encode($image_data);
            }
        } else {
            // Product not found in the database
            echo "Product not found.";
        }
    } else {
        // If 'product' parameter is not set, display an error message
        echo "Product name not provided.";
    }
    ?>
    <div class="container">
        <div class="imgcont">
            <?php if (isset($image_base64)) {
                echo "<img src='data:image/png;base64," . $image_base64 . "'>";
            } ?>
        </div>
        <div class="det">
            <p class="all"><?php echo $row['name'] . ' ' . $row['brand'] . ' ' . $row['color'] . ' ' . $row['category']; ?></p>
            <p class="price">£<?php echo $row['price']; ?></p>
            <hr>
        </div>
    </div>
</body>
</html>
