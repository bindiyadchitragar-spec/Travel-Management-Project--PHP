<?php
include 'config.php';

$id     = isset ( $_GET[ 'id' ] ) ? intval ( $_GET[ 'id' ] ) : 0;
$status = isset ( $_GET[ 'status' ] ) ? $_GET[ 'status' ] : '';

if ( $id <= 0 || ! in_array ( $status, [ 'booked', 'cancelled', 'completed' ] ) )
     {
     die ( "Invalid parameters." );
     }

$new_status = ( $status === 'booked' ) ? 'cancelled' : ( $status === 'cancelled' ? 'completed' : 'booked' );

$sql  = "UPDATE bookings SET status = ? WHERE id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( "si", $new_status, $id );
$stmt->execute ();

header ( "Location: admin_manage_booking.php" );
exit ();