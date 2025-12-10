<?php
include 'config.php';

// Fetch issues from the database
$sql    = "SELECT issues.id, issues.message, issues.status, issues.created_at, users.name AS user_name
        FROM issues
        JOIN users ON issues.user_id = users.id
        ORDER BY issues.created_at DESC";
$result = $conn->query ( $sql );

?>

<div class="content">
     <h1>Manage Issues</h1>
     <?php if ( $result->num_rows > 0 ) : ?>
     <table>
          <thead>
               <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
               </tr>
          </thead>
          <tbody>
               <?php while ( $row = $result->fetch_assoc () ) : ?>
               <tr>
                    <td><?= $row[ 'id' ] ?></td>
                    <td><?= htmlspecialchars ( $row[ 'user_name' ] ) ?></td>
                    <td><?= htmlspecialchars ( substr ( $row[ 'message' ], 0, 50 ) ) ?>...</td>
                    <td><?= htmlspecialchars ( $row[ 'status' ] ) ?></td>
                    <td><?= $row[ 'created_at' ] ?></td>
                    <td>
                         <a href="view_issue.php?id=<?= $row[ 'id' ] ?>">View</a>
                         <a
                              href="change_issue_status.php?id=<?= $row[ 'id' ] ?>&status=<?= $row[ 'status' ] === 'open' ? 'closed' : 'open' ?>">
                              <?= $row[ 'status' ] === 'open' ? 'Close' : 'Reopen' ?>
                         </a>
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>
     <?php else : ?>
     <p>No issues found.</p>
     <?php endif; ?>
</div>