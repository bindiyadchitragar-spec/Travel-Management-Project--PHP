<?php
include 'config.php';

$id = isset ( $_GET[ 'id' ] ) ? intval ( $_GET[ 'id' ] ) : 0;

if ( $id <= 0 )
     {
     die ( "Invalid Inquiry ID." );
     }

$sql  = "SELECT * FROM inquiries WHERE id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( "i", $id );
$stmt->execute ();
$result  = $stmt->get_result ();
$inquiry = $result->fetch_assoc ();

if ( ! $inquiry )
     {
     die ( "Inquiry not found." );
     }

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Inquiry Details</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>

     <div class="inquiry-content">
          <div class="inquiry-details">
               <h1>Inquiry Details</h1>
               <p><strong>ID:</strong> <?= htmlspecialchars ( $inquiry[ 'id' ] ) ?></p>
               <p><strong>Name:</strong> <?= htmlspecialchars ( $inquiry[ 'name' ] ) ?></p>
               <p><strong>Email:</strong> <?= htmlspecialchars ( $inquiry[ 'email' ] ) ?></p>
               <p><strong>Message:</strong></p>
               <p><?= htmlspecialchars ( $inquiry[ 'message' ] ) ?></p>
               <p><strong>Created At:</strong> <?= $inquiry[ 'created_at' ] ?></p>
               <p><a href="admin_dashboard.php?tab=manage_inquiries">Back to Inquiries</a>
               </p>
          </div>
     </div>
</body>

</html>