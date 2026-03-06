<?php
session_start();
include 'db.php';

// Handle Admin Login Logic
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if ($email == "admin@gym.com" && $pass == "123") {
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Invalid Admin Credentials');</script>";
    }
}

// Fetch dynamic products from database
$equipment_query = mysqli_query($conn, "SELECT * FROM products WHERE category='equipment'");
$accessories_query = mysqli_query($conn, "SELECT * FROM products WHERE category='accessories'");
$supplements_query = mysqli_query($conn, "SELECT * FROM products WHERE category='supplements'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Freaks Heaven | BD Online Shop</title>
    <style>
        /* CORE STYLES */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: #f4f4f4; color: #333; line-height: 1.6; }

        /* NAVIGATION */
        nav {
            background: #1a1a1a; color: white; padding: 15px 5%;
            display: flex; justify-content: space-between; align-items: center;
            position: fixed; width: 100%; top: 0; z-index: 1000;
        }
        .logo { font-size: 1.5rem; font-weight: bold; color: #ff4757; }
        nav ul { display: flex; list-style: none; }
        nav ul li { margin-left: 20px; }
        nav ul li a { color: white; text-decoration: none; font-size: 0.9rem; font-weight: bold; text-transform: uppercase; }
        nav ul li a:hover { color: #ff4757; }

        /* HERO SECTION */
        .hero { 
            height: 60vh;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=1350&q=80');
            background-size: cover; background-position: center;
            display: flex; flex-direction: column; justify-content: center; align-items: center; color: white; text-align: center;
        }

        /* SECTION HEADINGS */
        section { padding: 80px 5%; }
        h2 { text-align: center; font-size: 2.2rem; margin: 0 auto 40px auto; color: #faf9f9; text-transform: uppercase; border-bottom: 4px solid #ff4757; display: table; }

        /* PRODUCT GRID & DYNAMIC IMAGE FIX */
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 25px; }
        
        .card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: 0.3s; text-align: center; display: flex; flex-direction: column; }
        .card:hover { transform: translateY(-5px); }
        
        /* Fixed Image Container to prevent stretching */
        .img-container { width: 100%; height: 220px; overflow: hidden; background: #fff; display: flex; align-items: center; justify-content: center; padding: 10px; }
        .card img { max-width: 100%; max-height: 100%; object-fit: contain; } /* 'contain' ensures the whole product shows without cropping */

        .card-content { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .card h3 { font-size: 1.1rem; margin-bottom: 8px; color: #222; height: 45px; overflow: hidden; }
        .card p { font-size: 0.85rem; color: #666; margin-bottom: 10px; }
        .price { color: #2ed573; font-weight: bold; font-size: 1.3rem; margin-bottom: 15px; }

        .book-btn { background: #ff4757; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-weight: bold; transition: 0.3s; }
        .book-btn:hover { background: #e03d4a; }

        /* AUTH FORMS */
        #auth { background: #222; color: white; }
        .form-container { max-width: 400px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; color: #333; }
        .form-container input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        .toggle-link { color: #ff4757; cursor: pointer; font-weight: bold; }
        .hidden { display: none; }
        .marqueetxt{
            font-size: 20px;
        }

        footer { background: #111; color: white; padding: 50px 5%; text-align: center; }
        .socials a { color: #ff4757; margin: 0 15px; text-decoration: none; }
        .headings{
            color:black;

        }
    </style>
</head>
<body>

<nav>
    <div class="logo"><marquee behavior="" direction="right">GYM FREAKS HEAVEN</marquee></div>
    <ul>
        <li><a href="#equipment">Equipment</a></li>
        <li><a href="#accessories">Accessories</a></li>
        <li><a href="#supplements">Supplements</a></li>
        <li><a href="#auth">Admin</a></li>
    </ul>
</nav>

<section class="hero">
    <h1>ELEVATE YOUR TRAINING</h1>
    <p>Bangladesh's Premier Destination for Gym Hardware & Nutrition</p>
</section>
<marquee behavior="" direction="left"><p class="marqueetxt"><b>These products only available to us. We are providing the best product in our site. Choose and roll on.</b></p></marquee>
<section id="equipment">
    <h2 class="headings">Gym Equipment</h2>
    <div class="grid">
        <?php if(mysqli_num_rows($equipment_query) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($equipment_query)): ?>
            <div class="card">
                <div class="img-container">
                    <img src="<?php echo $row['image']; ?>" alt="Product">
                </div>
                <div class="card-content">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <div class="price"><?php echo number_format($row['price']); ?> BDT</div>
                    <!-- <a href="order_page.php" class="book-btn">Book Now</a> -->
                     <a href="order_page.php?item=<?php echo urlencode($row['name']); ?>&price=<?php echo $row['price']; ?>&img=<?php echo urlencode($row['image']); ?>" class="book-btn">Book Now</a>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: echo "<p style='text-align:center; grid-column: 1/-1;'>No equipment available.</p>"; endif; ?>
    </div>
</section>

<section id="accessories">
    <h2 class="headings">Gym Accessories</h2>
    <div class="grid">
        <?php if(mysqli_num_rows($accessories_query) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($accessories_query)): ?>
            <div class="card">
                <div class="img-container">
                    <img src="<?php echo $row['image']; ?>" alt="Product">
                </div>
                <div class="card-content">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <div class="price"><?php echo number_format($row['price']); ?> BDT</div>
                    <!-- <a href="order_page.php" class="book-btn">Book Now</a> -->
                     <a href="order_page.php?item=<?php echo urlencode($row['name']); ?>&price=<?php echo $row['price']; ?>&img=<?php echo urlencode($row['image']); ?>" class="book-btn">Book Now</a>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: echo "<p style='text-align:center; grid-column: 1/-1;'>No accessories available.</p>"; endif; ?>
    </div>
</section>

<section id="supplements">
    <h2 class="headings">Supplements</h2>
    <div class="grid">
        <?php if(mysqli_num_rows($supplements_query) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($supplements_query)): ?>
            <div class="card">
                <div class="img-container">
                    <img src="<?php echo $row['image']; ?>" alt="Product">
                </div>
                <div class="card-content">
                    <h3><?php echo $row['name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <div class="price"><?php echo number_format($row['price']); ?> BDT</div>
                    <!-- <a href="order_page.php" class="book-btn">Book Now</a> -->
                     <a href="order_page.php?item=<?php echo urlencode($row['name']); ?>&price=<?php echo $row['price']; ?>&img=<?php echo urlencode($row['image']); ?>" class="book-btn">Book Now</a>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: echo "<p style='text-align:center; grid-column: 1/-1;'>No supplements available.</p>"; endif; ?>
    </div>
</section>

<section id="auth">
    <h2>Admin Portal</h2>
    <div class="form-container" id="loginForm">
        <form method="POST">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login_btn" class="book-btn" style="width:100%">LOGIN AS ADMIN</button>
        </form>
    </div>
</section>

<footer>
    <h2>Gym Freaks Heaven</h2>
    <p>Providing the best gym solutions in Bangladesh since 2020.</p>
    <div class="socials">
        <a href="https://www.facebook.com/saha.pradyumna.prasad">Facebook</a> | <a href="https://www.instagram.com/ankur_200308?igsh=MW1neWUxbjhocWJ3Zw==">Instagram</a> | <a href="#">WhatsApp:01890255384</a>
    </div>
    <p style="margin-top:30px; font-size: 0.8rem; color: #777;">&copy; 2026 Gym Freaks Heaven.</p>
</footer>

</body>
</html>