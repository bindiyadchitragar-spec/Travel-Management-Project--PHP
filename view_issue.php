<?php
include 'config.php';

$id = isset ( $_GET[ 'id' ] ) ? intval ( $_GET[ 'id' ] ) : 0;

if ( $id <= 0 )
     {
     die ( "Invalid Issue ID." );
     }

$sql  = "SELECT issues.id, issues.message, issues.status, issues.created_at, users.name AS user_name
        FROM issues
        JOIN users ON issues.user_id = users.id
        WHERE issues.id = ?";
$stmt = $conn->prepare ( $sql );
$stmt->bind_param ( "i", $id );
$stmt->execute ();
$result = $stmt->get_result ();
$issue  = $result->fetch_assoc ();

if ( ! $issue )
     {
     die ( "Issue not found." );
     }

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>View Issue</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>
     <div class="inquiry-content">
          <h1>Issue Details</h1>
          <div class="inquiry-details">
               <p><strong>ID:</strong> <?= htmlspecialchars ( $issue[ 'id' ] ) ?></p>
               <p><strong>User:</strong> <?= htmlspecialchars ( $issue[ 'user_name' ] ) ?></p>
               <p><strong>Message:</strong></p>
               <p><?= htmlspecialchars ( $issue[ 'message' ] ) ?></p>
               <p><strong>Status:</strong> <?= htmlspecialchars ( $issue[ 'status' ] ) ?></p>
               <p><strong>Created At:</strong> <?= $issue[ 'created_at' ] ?></p>
               <a href="admin_dashboard.php?tab=manage_issues">Back to Issues</a>
          </div>
     </div>

</body>

</html>