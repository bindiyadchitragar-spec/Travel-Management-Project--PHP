<?php
include 'config.php';

// Fetch bookings from the database
$sql    = "SELECT bookings.id, users.name AS user_name, packages.name AS package_name, bookings.status, bookings.created_at
        FROM bookings
        JOIN users ON bookings.user_id = users.id
        JOIN packages ON bookings.package_id = packages.id
        ORDER BY bookings.created_at DESC";
$result = $conn->query ( $sql );

?>

<div class="content">
     <h1>Manage Bookings</h1>
     <?php if ( $result->num_rows > 0 ) : ?>
     <table>
          <thead>
               <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Package</th>
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
                    <td><?= htmlspecialchars ( $row[ 'package_name' ] ) ?></td>
                    <td><?= htmlspecialchars ( $row[ 'status' ] ) ?></td>
                    <td><?= $row[ 'created_at' ] ?></td>
                    <td>
                         <a href="view_booking.php?id=<?= $row[ 'id' ] ?>">View</a>
                         <a
                              href="change_booking_status.php?id=<?= $row[ 'id' ] ?>&status=<?= $row[ 'status' ] === 'booked' ? 'cancelled' : ( $row[ 'status' ] === 'cancelled' ? 'completed' : 'booked' ) ?>">
                              <?= $row[ 'status' ] === 'booked' ? 'Cancel' : ( $row[ 'status' ] === 'cancelled' ? 'Complete' : 'Reopen' ) ?>
                         </a>
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>
     <?php else : ?>
     <p>No bookings found.</p>
     <?php endif; ?>
</div>