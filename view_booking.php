<?php
include 'config.php';

$id = isset ( $_GET[ 'id' ] ) ? intval ( $_GET[ 'id' ] ) : 0;

if ( $id <= 0 )
     {
     die ( "Invalid Booking ID." );
     }

$sql  = "SELECT bookings.id, users.name AS user_name, packages.name AS package_name, bookings.status, bookings.created_at
        FROM bookings
        JOIN users ON bookings.user_id = users.id
        JOIN packages ON bookings.package_id = packages.id
        WHERE bookings.id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( "i", $id );
$stmt->execute ();
$result  = $stmt->get_result ();
$booking = $result->fetch_assoc ();

if ( ! $booking )
     {
     die ( "Booking not found." );
     }

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>View Booking</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
</head>

<body>
     <div class="inquiry-content">
          <h1>Booking Details</h1>
          <div class="inquiry-details">
               <p><strong>ID:</strong> <?= htmlspecialchars ( $booking[ 'id' ] ) ?></p>
               <p><strong>User:</strong> <?= htmlspecialchars ( $booking[ 'user_name' ] ) ?></p>
               <p><strong>Package:</strong> <?= htmlspecialchars ( $booking[ 'package_name' ] ) ?></p>
               <p><strong>Status:</strong> <?= htmlspecialchars ( $booking[ 'status' ] ) ?></p>
               <p><strong>Created At:</strong> <?= $booking[ 'created_at' ] ?></p>
               <a href="admin_dashboard.php?tab=manage_booking">Back to Bookings</a>
          </div>
     </div>
</body>

</html>