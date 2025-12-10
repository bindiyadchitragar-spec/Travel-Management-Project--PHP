<?php
include 'config.php';

// Initialize variables
$name     = $email = $role = "";
$name_err = $email_err = $role_err = "";

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

     // Check input errors before inserting into the database
     if ( empty ( $name_err ) && empty ( $email_err ) && empty ( $role_err ) )
          {
          // Prepare an insert statement
          $sql = "INSERT INTO users (name, email, role) VALUES (?, ?, ?)";

          if ( $stmt = $conn->prepare ( $sql ) )
               {
               // Bind variables to the prepared statement
               $stmt->bind_param ( "sss", $param_name, $param_email, $param_role );

               // Set parameters
               $param_name  = $name;
               $param_email = $email;
               $param_role  = $role;

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
     <title>Add User</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>
     <div class="container">
          <div class="box">
               <h2>Add New User</h2>
               <form action="<?php echo htmlspecialchars ( $_SERVER[ "PHP_SELF" ] ); ?>" method="post">
                    <div class="form-group">
                         <input type="text" id="name" placeholder="Name" name="name"
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
                         <button type="submit">Add User</button>
                    </div>
                    <a class="back-link" href="admin_dashboard.php?tab=manage_users">Back to User Management</a>
               </form>
          </div>
     </div>
</body>

</html>