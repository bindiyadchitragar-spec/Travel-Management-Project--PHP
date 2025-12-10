<?php
include 'config.php';

// Initialize variables
$name     = $email = $role = "";
$name_err = $email_err = $role_err = "";

// Get user ID from query string
$user_id = isset ( $_GET[ 'id' ] ) ? intval ( $_GET[ 'id' ] ) : 0;

// Fetch user data if ID is valid
if ( $user_id > 0 )
     {
     // Prepare a select statement
     $sql = "SELECT name, email, role FROM users WHERE id = ?";

     if ( $stmt = $conn->prepare ( $sql ) )
          {
          // Bind variables to the prepared statement
          $stmt->bind_param ( "i", $user_id );

          // Attempt to execute the statement
          if ( $stmt->execute () )
               {
               $result = $stmt->get_result ();
               if ( $result->num_rows === 1 )
                    {
                    // Fetch the row
                    $row   = $result->fetch_assoc ();
                    $name  = $row[ 'name' ];
                    $email = $row[ 'email' ];
                    $role  = $row[ 'role' ];
                    }
               else
                    {
                    echo "No user found with the specified ID.";
                    exit ();
                    }
               }
          else
               {
               echo "Oops! Something went wrong. Please try again later.";
               exit ();
               }

          // Close statement
          $stmt->close ();
          }
     }

// Process form submission
if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" )
     {
     // Validate name
     if ( empty ( trim ( $_POST[ "name" ] ) ) )
          {
          $name_err = "Please enter a name.";
          }
     else
          {
          $name = trim ( $_POST[ "name" ] );
          }

     // Validate email
     if ( empty ( trim ( $_POST[ "email" ] ) ) )
          {
          $email_err = "Please enter an email.";
          }
     elseif ( ! filter_var ( trim ( $_POST[ "email" ] ), FILTER_VALIDATE_EMAIL ) )
          {
          $email_err = "Invalid email format.";
          }
     else
          {
          $email = trim ( $_POST[ "email" ] );
          }

     // Validate role
     if ( empty ( trim ( $_POST[ "role" ] ) ) )
          {
          $role_err = "Please select a role.";
          }
     else
          {
          $role = trim ( $_POST[ "role" ] );
          }

     // Check input errors before updating in the database
     if ( empty ( $name_err ) && empty ( $email_err ) && empty ( $role_err ) )
          {
          // Prepare an update statement
          $sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";

          if ( $stmt = $conn->prepare ( $sql ) )
               {
               // Bind variables to the prepared statement
               $stmt->bind_param ( "sssi", $param_name, $param_email, $param_role, $param_id );

               // Set parameters
               $param_name  = $name;
               $param_email = $email;
               $param_role  = $role;
               $param_id    = $user_id;

               // Attempt to execute the statement
               if ( $stmt->execute () )
                    {
                    // Redirect to manage users page
                    header ( "location: admin_dashboard.php?tab=manage_users" );
                    exit ();
                    }
               else
                    {
                    echo "Oops! Something went wrong. Please try again later.";
                    }

               // Close statement
               $stmt->close ();
               }
          }

     // Close connection
     $conn->close ();
     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edit User</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>
     <div class="container">
          <div class="box">
               <h1>Edit User</h1>
               <form action="<?php echo htmlspecialchars ( $_SERVER[ "PHP_SELF" ] ) . '?id=' . $user_id; ?>"
                    method="post">
                    <div class="form-group">
                         <input type="text" placeholder="Name" id="name" name="name"
                              value="<?php echo htmlspecialchars ( $name ); ?>">
                         <span class="error"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group">
                         <input type="email" placeholder="Email" id="email" name="email"
                              value="<?php echo htmlspecialchars ( $email ); ?>">
                         <span class="error"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                         <label for="role">Role</label>
                         <select id="role" name="role">
                              <option value="">Select Role</option>
                              <option value="admin" <?php echo ( $role == 'admin' ) ? 'selected' : ''; ?>>Admin</option>
                              <option value="user" <?php echo ( $role == 'user' ) ? 'selected' : ''; ?>>User</option>
                         </select>
                         <span class="error"><?php echo $role_err; ?></span>
                    </div>
                    <div class="form-group">
                         <button type="submit">Update User</button>
                    </div>
                    <a class="back-link" href="admin_dashboard.php?tab=manage_users">Back to User Management</a>
               </form>
          </div>
     </div>
</body>

</html>