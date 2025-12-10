<?php
include 'config.php';

// Fetch all users from the database
$sql    = "SELECT id, name, email, role FROM users";
$result = $conn->query ( $sql );

$users = [];
if ( $result->num_rows > 0 )
     {
     while ( $row = $result->fetch_assoc () )
          {
          $users[] = $row;
          }
     }

$conn->close ();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Manage Users</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>
     <div class="container-manage">
          <h1>Manage Users</h1>
          <a class="add_user" href="admin_add_user.php">Add New User</a>
          <table>
               <thead>
                    <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Role</th>
                         <th>Actions</th>
                    </tr>
               </thead>
               <tbody>
                    <?php if ( count ( $users ) > 0 ) : ?>
                    <?php foreach ( $users as $user ) : ?>
                    <tr>
                         <td><?= htmlspecialchars ( $user[ 'id' ] ) ?></td>
                         <td><?= htmlspecialchars ( $user[ 'name' ] ) ?></td>
                         <td><?= htmlspecialchars ( $user[ 'email' ] ) ?></td>
                         <td><?= htmlspecialchars ( $user[ 'role' ] ) ?></td>
                         <td class="action-buttons">
                              <a href="admin_edit_user.php?id=<?= htmlspecialchars ( $user[ 'id' ] ) ?>"
                                   class="edit">Edit</a>
                              <a href="admin_delete_user.php?id=<?= htmlspecialchars ( $user[ 'id' ] ) ?>"
                                   class="delete"
                                   onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                         </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <tr>
                         <td colspan="5">No users found</td>
                    </tr>
                    <?php endif; ?>
               </tbody>
          </table>
     </div>
</body>

</html>