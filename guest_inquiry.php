<?php
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
     {
     include 'config.php';
     $name    = $_POST[ 'name' ];
     $email   = $_POST[ 'email' ];
     $message = $_POST[ 'message' ];

     $stmt = $conn->prepare ( "INSERT INTO inquiries (name, email, message) VALUES (?, ?, ?)" );
     $stmt->bind_param ( "sss", $name, $email, $message );

     if ( $stmt->execute () )
          {
          $response = "Inquiry submitted successfully!";
          }
     else
          {
          $response = "Error: " . $stmt->error;
          }
     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Guest Inquiry</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body style="backgroung-image: url('styles/images/register.jpg')">
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
     <div class="container">
          <div class="login-content">
               <h2>Guest Inquiry</h2>
               <?php if ( ! empty ( $response ) ) : ?>
               <div class="response"><?= $response ?></div>
               <?php endif; ?>
               <form method="POST" action="guest_inquiry.php">
                    <input type="text" name="name" required placeholder="Name">
                    <input type="email" name="email" required placeholder="Email">
                    <textarea name="message" required placeholder="Message"></textarea>
                    <button type="submit">Submit Inquiry</button>
               </form>
          </div>
     </div>
</body>

</html>