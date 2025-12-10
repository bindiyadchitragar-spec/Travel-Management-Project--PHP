<?php
include 'config.php';

// Check if user is logged in
if ( ! isset ( $_SESSION[ 'user_id' ] ) )
     {
     header ( "Location: login.php" );
     exit ();
     }

$user_id = $_SESSION[ 'user_id' ];

// Fetch user information
$sql  = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( 'i', $user_id );
$stmt->execute ();
$result = $stmt->get_result ();
$user   = $result->fetch_assoc ();

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' )
     {
     // Handle profile update
     $name             = $_POST[ 'name' ];
     $email            = $_POST[ 'email' ];
     $current_password = $_POST[ 'current_password' ];
     $new_password     = $_POST[ 'new_password' ];
     $confirm_password = $_POST[ 'confirm_password' ];

     $error_message = '';

     // Check if current password is correct
     if ( ! empty ( $current_password ) )
          {
          if ( password_verify ( $current_password, $user[ 'password' ] ) )
               {
               if ( ! empty ( $new_password ) && $new_password === $confirm_password )
                    {
                    // Hash new password
                    $hashed_password = password_hash ( $new_password, PASSWORD_DEFAULT );

                    // Update user information
                    $sql_update  = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
                    $stmt_update = $conn->prepare ( $sql_update );
                    $stmt_update->bind_param ( 'sssi', $name, $email, $hashed_password, $user_id );

                    if ( $stmt_update->execute () )
                         {
                         $success_message = "Profile updated successfully!";
                         // Refresh the user data
                         $stmt->execute ();
                         $result = $stmt->get_result ();
                         $user   = $result->fetch_assoc ();
                         }
                    else
                         {
                         $error_message = "Error updating profile: " . $conn->error;
                         }
                    }
               else
                    {
                    $error_message = "New passwords do not match.";
                    }
               }
          else
               {
               $error_message = "Current password is incorrect.";
               }
          }
     else
          {
          // Update user information without changing the password
          $sql_update  = "UPDATE users SET name = ?, email = ? WHERE id = ?";
          $stmt_update = $conn->prepare ( $sql_update );
          $stmt_update->bind_param ( 'ssi', $name, $email, $user_id );

          if ( $stmt_update->execute () )
               {
               $success_message = "Profile updated successfully!";
               // Refresh the user data
               $stmt->execute ();
               $result = $stmt->get_result ();
               $user   = $result->fetch_assoc ();
               }
          else
               {
               $error_message = "Error updating profile: " . $conn->error;
               }
          }
     }
?>

<div class="content">
     <h2>My Profile</h2>

     <?php if ( isset ( $success_message ) ) : ?>
     <p class="success-message"><?= htmlspecialchars ( $success_message ) ?></p>
     <?php endif; ?>

     <?php if ( isset ( $error_message ) ) : ?>
     <p class="error-message"><?= htmlspecialchars ( $error_message ) ?></p>
     <?php endif; ?>

     <form method="post">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value="<?= htmlspecialchars ( $user[ 'name' ] ) ?>" required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars ( $user[ 'email' ] ) ?>" required>

          <label for="current_password">Current Password:</label>
          <input type="password" id="current_password" name="current_password">

          <label for="new_password">New Password:</label>
          <input type="password" id="new_password" name="new_password">

          <label for="confirm_password">Confirm New Password:</label>
          <input type="password" id="confirm_password" name="confirm_password">

          <button type="submit">Update Profile</button>
     </form>
</div>