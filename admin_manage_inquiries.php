<?php
include 'config.php';

// Fetch inquiries from the database
$sql    = "SELECT * FROM inquiries ORDER BY created_at DESC";
$result = $conn->query ( $sql );

?>


<div class="content">
     <h1>Manage Inquiries</h1>
     <?php if ( $result->num_rows > 0 ) : ?>
     <table>
          <thead>
               <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Actions</th>
               </tr>
          </thead>
          <tbody>
               <?php while ( $row = $result->fetch_assoc () ) : ?>
               <tr>
                    <td><?= $row[ 'id' ] ?></td>
                    <td><?= htmlspecialchars ( $row[ 'name' ] ) ?></td>
                    <td><?= htmlspecialchars ( $row[ 'email' ] ) ?></td>
                    <td><?= htmlspecialchars ( substr ( $row[ 'message' ], 0, 50 ) ) ?>...</td>
                    <td><?= $row[ 'created_at' ] ?></td>
                    <td>
                         <a href="view_inquiry.php?id=<?= $row[ 'id' ] ?>">View</a>
                         <!-- Add delete functionality if needed -->
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>
     <?php else : ?>
     <p>No inquiries found.</p>
     <?php endif; ?>
</div>