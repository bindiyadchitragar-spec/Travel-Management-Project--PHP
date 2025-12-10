<?php
session_start ();
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
     {
     include 'config.php';
     $email    = $_POST[ 'email' ];
     $password = $_POST[ 'password' ];

     $stmt = $conn->prepare ( "SELECT id, name, password, role FROM users WHERE email = ?" );
     $stmt->bind_param ( "s", $email );
     $stmt->execute ();
     $stmt->bind_result ( $id, $name, $hashed_password, $role );
     $stmt->fetch ();

     if ( password_verify ( $password, $hashed_password ) )
          {
          $_SESSION[ 'user_id' ] = $id;
          $_SESSION[ 'name' ]    = $name;
          $_SESSION[ 'role' ]    = $role;

          if ( $role == 'admin' )
               {
               header ( "Location: admin_dashboard.php" );
               }
          else
               {
               header ( "Location: user_dashboard.php" );
               }
          exit ();
          }
     else
          {
          echo "Invalid email or password";
          }
     }
?>
<?php include 'assets/head.php' ?>
<div class="container">
     <div class="login-content">
          <div class="login-header">
               <p>Login</p>
          </div>
          <div class="login-box">
               <form method="POST">
                    <form method="POST">
                         <input type="email" name="email" required placeholder="Email">
                         <input type="password" name="password" required placeholder="Password">
                         <button type="submit">Login</button>
                    </form>
               </form>
          </div>
     </div>
</div>