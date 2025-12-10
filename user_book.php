<?php
session_start ();
include 'config.php';

// Check if user is logged in
if ( ! isset ( $_SESSION[ 'user_id' ] ) )
     {
     header ( "Location: login.php" );
     exit ();
     }

// Check if package_id is set
if ( ! isset ( $_GET[ 'package_id' ] ) )
     {
     header ( "Location: user_home.php" );
     exit ();
     }

$package_id = intval ( $_GET[ 'package_id' ] );
$user_id    = $_SESSION[ 'user_id' ];

// Insert booking into the database
$sql  = "INSERT INTO bookings (user_id, package_id, status) VALUES (?, ?, 'booked')";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( 'ii', $user_id, $package_id );

if ( $stmt->execute () )
     {
     header ( "location: user_dashboard.php?tab=my_bookings" );
     }
else
     {
     echo "Error: " . $conn->error;
     }

$stmt->close ();
$conn->close ();
?>