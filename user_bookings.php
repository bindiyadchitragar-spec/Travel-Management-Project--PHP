<?php
include 'config.php';

// Check if user is logged in
if ( ! isset ( $_SESSION[ 'user_id' ] ) )
     {
     header ( "Location: login.php" );
     exit ();
     }

$user_id = $_SESSION[ 'user_id' ];

// Handle booking cancellation
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset ( $_POST[ 'cancel_booking_id' ] ) )
     {
     $booking_id = $_POST[ 'cancel_booking_id' ];

     // Update booking status to 'cancelled' and set cancelled_on date
     $sql_cancel  = "UPDATE bookings SET status = 'cancelled', cancelled_on = NOW() WHERE id = ? AND user_id = ?";
     $stmt_cancel = $conn->prepare ( $sql_cancel );
     $stmt_cancel->bind_param ( 'ii', $booking_id, $user_id );

     if ( $stmt_cancel->execute () )
          {
          $success_message = "Booking cancelled successfully!";
          }
     else
          {
          $error_message = "Error cancelling booking: " . $conn->error;
          }
     }

// Query to get user bookings
$sql  = "SELECT bookings.id, packages.name, packages.description, packages.price, bookings.status, bookings.booked_on, bookings.cancelled_on 
        FROM bookings 
        JOIN packages ON bookings.package_id = packages.id 
        WHERE bookings.user_id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( 'i', $user_id );
$stmt->execute ();
$result = $stmt->get_result ();
?>
<div class="booking-content">
     <h2>My Bookings</h2>
     <?php if ( isset ( $success_message ) ) : ?>
     <p class="success-message"><?= htmlspecialchars ( $success_message ) ?></p>
     <?php endif; ?>
     <?php if ( isset ( $error_message ) ) : ?>
     <p class="error-message"><?= htmlspecialchars ( $error_message ) ?></p>
     <?php endif; ?>
     <div class="bookings-container">
          <?php if ( $result->num_rows > 0 ) : ?>
          <?php while ( $row = $result->fetch_assoc () ) : ?>
          <div class="booking-card">
               <h3 class="booking-title"><?= htmlspecialchars ( $row[ 'name' ] ) ?></h3>
               <p class="booking-description"><?= htmlspecialchars ( $row[ 'description' ] ) ?></p>
               <p class="booking-price">$<?= htmlspecialchars ( number_format ( $row[ 'price' ], 2 ) ) ?></p>
               <p class="booking-status">Status: <?= htmlspecialchars ( ucfirst ( $row[ 'status' ] ) ) ?></p>
               <p class="booking-booked-on">Booked On: <?= htmlspecialchars ( $row[ 'booked_on' ] ) ?></p>
               <?php if ( $row[ 'status' ] === 'cancelled' ) : ?>
               <p class="booking-cancelled-on">Cancelled On: <?= htmlspecialchars ( $row[ 'cancelled_on' ] ) ?></p>
               <?php elseif ( $row[ 'status' ] !== 'cancelled' ) : ?>
               <form class="cancle-form" method="post">
                    <input type="hidden" name="cancel_booking_id" value="<?= $row[ 'id' ] ?>">
                    <button type="submit" class="cancel-button">Cancel Booking</button>
               </form>
               <?php endif; ?>
          </div>
          <?php endwhile; ?>
          <?php else : ?>
          <p>You have no bookings.</p>
          <?php endif; ?>
     </div>
</div>