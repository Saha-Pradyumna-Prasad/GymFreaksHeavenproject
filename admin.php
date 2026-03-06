<?php
session_start();
include 'db.php';

// Simple admin login check
if (!isset($_SESSION['is_admin'])) {
    if (isset($_POST['login'])) {
        if ($_POST['email'] == "admin@gym.com" && $_POST['pass'] == "123") {
            $_SESSION['is_admin'] = true;
        } else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
    } else {
        echo '<div style="text-align:center; margin-top:100px;">
                <form method="POST" style="display:inline-block; padding:20px; border:1px solid #ddd;">
                    <h3>Admin Access</h3>
                    <input type="email" name="email" placeholder="Email" required style="display:block; margin:10px auto; padding:8px;"><br>
                    <input type="password" name="pass" placeholder="Password" required style="display:block; margin:10px auto; padding:8px;"><br>
                    <button name="login" style="padding:10px 20px; cursor:pointer;">Login</button>
                </form>
              </div>';
        exit;
    }
}

// Handle Adding Product (Using Image Link)
if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $img_link = mysqli_real_escape_string($conn, $_POST['image_url']); 

    $sql = "INSERT INTO products (name, price, category, description, image) VALUES ('$name', '$price', '$cat', '$desc', '$img_link')";
    mysqli_query($conn, $sql);
    header('location: admin.php'); // Refresh to show new product
}

// Handle Deleting Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header('location: admin.php');
}

$all_products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 40px; background: #f0f2f5; }
        .container { max-width: 900px; margin: auto; }
        .box { background: white; padding: 25px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-flex { display: flex; justify-content: space-between; align-items: center; }
        input, select, textarea { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #ff4757; color: white; border: none; padding: 12px 25px; cursor: pointer; border-radius: 5px; font-weight: bold; }
        .btn-home { background: #2f3542; text-decoration: none; padding: 10px 15px; color: white; border-radius: 5px; font-size: 0.9rem; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; }
        th, td { border-bottom: 1px solid #eee; padding: 15px; text-align: left; }
        th { background: #1a1a1a; color: white; }
        .img-preview { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-flex">
        <h1>Admin Dashboard</h1>
        <a href="index.php" class="btn-home">Log out</a>
    </div>

    <div class="box">
        <h2>Add New Product</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="number" name="price" placeholder="Price (BDT)" required>
            <select name="category">
                <option value="equipment">Gym Equipment</option>
                <option value="accessories">Gym Accessories</option>
                <option value="supplements">Supplements</option>
            </select>
            <input type="url" name="image_url" placeholder="Paste Image URL here (https://...)" required>
            <textarea name="desc" placeholder="Brief Description" rows="3"></textarea>
            <button type="submit" name="add_product" class="btn">Save & Publish Product</button>
        </form>
    </div>

    <div class="box">
        <h2>Live Products</h2>
        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($all_products)): ?>
            <tr>
                <td><img src="<?php echo $row['image']; ?>" class="img-preview"></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo ucfirst($row['category']); ?></td>
                <td><?php echo $row['price']; ?> BDT</td>
                <td><a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" style="color:#ff4757; text-decoration:none; font-weight:bold;">Remove</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>

</body>
</html>