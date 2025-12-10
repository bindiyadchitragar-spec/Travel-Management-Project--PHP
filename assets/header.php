<?php
session_start ();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Volunteer Management System</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.png" type="image/png">
</head>

<body>
     <header>
          <div class="logo-container">
               <img src="styles/images/logo.png" alt="Winsoft Solutions Logo" class="logo">
          </div>
          <nav>
               <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="notifications.php">Notifications</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <?php if ( isset ( $_SESSION[ 'user_id' ] ) ) : ?>
                    <li><a href="logout.php">Logout</a></li>
                    <?php else : ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
               </ul>
          </nav>
     </header>