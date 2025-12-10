<?php
session_start ();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Tourism Management System</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>
     <header>
          <div class="logo-container">
               <img src="styles/images/logo.jpg" alt="Logo" class="logo">
          </div>
          <nav>
               <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="guest_inquiry.php">Inquiry</a></li>
               </ul>
          </nav>
     </header>
     <div class="content">
          <h1>Welcome to the Tourism Management System</h1>
          <p>Explore various tour packages and book your next adventure with us!</p>
          <p>If you have any questions or need further information, feel free to make an inquiry.</p>
     </div>
     <?php include 'assets/footer.php'; ?>
</body>

</html>