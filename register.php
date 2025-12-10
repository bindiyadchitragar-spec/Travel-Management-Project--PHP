<?php
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
     {
     include 'config.php';
     $name     = $_POST[ 'name' ];
     $email    = $_POST[ 'email' ];
     $password = password_hash ( $_POST[ 'password' ], PASSWORD_BCRYPT );
     $role     = 'user';

     // Ensure only valid roles are accepted
     if ( ! in_array ( $role, [ 'user', 'admin' ] ) )
          {
          die ( 'Invalid role selected.' );
          }

     $stmt = $conn->prepare ( "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)" );
     $stmt->bind_param ( "ssss", $name, $email, $password, $role );

     if ( $stmt->execute () )
          {
          header ( "Location: login.php" );
          exit ();
          }
     else
          {
          echo "Error: " . $stmt->error;
          }
     }
?>
<?php include 'assets/head.php' ?>
<div class="container">
     <div class="login-content">
          <div class="login-header">
               <p>Register</p>
          </div>
          <div class="login-box">
               <form method="POST" action="register.php">
                    <input type="text" name="name" required placeholder="Name">
                    <input type="email" name="email" required placeholder="Email">
                    <input type="password" name="password" required placeholder="Password">
                    <button type="submit">Register</button>
               </form>
               </form>
          </div>
     </div>
</div>