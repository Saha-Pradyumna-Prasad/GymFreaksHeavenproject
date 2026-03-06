<?php
include 'db.php';

$success = false;
$form_submitted = false;

// 1. Handle the Form Submission (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_submitted = true;
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
    $customer_transaction = mysqli_real_escape_string($conn, $_POST['customer_transaction']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);
    
    // Prepare the SQL query
    $sql = "INSERT INTO bookings (product_name, customer_name, address,transaction, phone) 
            VALUES ('$product_name', '$customer_name', '$customer_address','$customer_address', '$customer_phone')";

    if (mysqli_query($conn, $sql)) {
        $success = true;
    }
}

// 2. Get Product Info from URL (GET) to display in the form
$item_name = isset($_GET['item']) ? htmlspecialchars($_GET['item']) : '';
$item_price = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '';
$item_img = isset($_GET['img']) ? htmlspecialchars($_GET['img']) : ''; // Capture the image URL
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Gym Freaks Heaven</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f1f2f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); width: 100%; max-width: 500px; text-align: center; }
        
        /* Product Preview Styles */
        .product-preview { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .product-preview img { max-width: 150px; height: auto; border-radius: 8px; margin-bottom: 10px; }
        .product-preview h2 { font-size: 1.4rem; color: #333; margin: 5px 0; }
        .price-tag { color: #2ed573; font-weight: bold; font-size: 1.2rem; }

        input, textarea { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn { background: #ff4757; color: white; padding: 12px 25px; text-decoration: none; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%; display: inline-block; transition: 0.3s; }
        .btn:hover { background: #e03d4a; }
        .success-msg { color: #2ed573; }
        .error-msg { color: #ff4757; }
    </style>
</head>
<body>

<div class="card">
    <?php if ($form_submitted): ?>
        <?php if ($success): ?>
            <h1 class="success-msg">Order Confirmed!</h1>
            <p>Thank you, <strong><?php echo htmlspecialchars($customer_name); ?></strong>. Your booking for <strong><?php echo htmlspecialchars($product_name); ?></strong> has been received.</p>
            <br>
            <a href="home_page.php" class="btn">Back to Shop</a>
        <?php else: ?>
            <h1 class="error-msg">Order Failed</h1>
            <p>Error: <?php echo mysqli_error($conn); ?></p>
            <a href="index.php" class="btn">Try Again</a>
        <?php endif; ?>

    <?php else: ?>
        <div class="product-preview">
            <?php if ($item_img): ?>
                <img src="<?php echo $item_img; ?>" alt="Product Image">
            <?php endif; ?>
            <h2><?php echo $item_name; ?></h2>
            <p class="price-tag"><?php echo number_format((float)$item_price); ?> BDT</p>
        </div>

        <h3>Customer Information</h3>
        <form method="POST" action="order_page.php">
            <input type="hidden" name="product_name" value="<?php echo $item_name; ?>">
            
            <input type="text" name="customer_name" placeholder="Full Name" required>
            <input type="text" name="customer_phone" placeholder="Phone Number" required>
            <label for="">Bkash:01701351375</label><br>
            <label for="">Nagad:01890255384</label>
            <textarea name="customer_address" placeholder="Shipping Address" rows="3" required></textarea>
            <label for="">Transaction</label>
            <input type="text" name="customer_transaction">
            
            <button type="submit" class="btn">Place Order Now</button>
        </form>
        <br>
        <a href="home_page.php" style="color: #666; font-size: 0.9rem; text-decoration: none;">← Cancel and return to shop</a>
    <?php endif; ?>
</div>

</body>
</html>