<?php
include 'config.php';

// Query to get the total number of users
$sql    = "SELECT COUNT(*) AS total_users FROM users";
$result = $conn->query ( $sql );

$total_users = 0;
if ( $result->num_rows > 0 )
     {
     $row         = $result->fetch_assoc ();
     $total_users = $row[ 'total_users' ];
     }

// Query to get the total number of issues
$sql1         = "SELECT COUNT(*) AS total_issues FROM issues";
$result1      = $conn->query ( $sql1 );
$total_issues = 0;
if ( $result1->num_rows > 0 )
     {
     $row          = $result1->fetch_assoc ();
     $total_issues = $row[ 'total_issues' ];
     }

// Query to get the total number of packages
$sql2           = "SELECT COUNT(*) AS total_packages FROM packages";
$result2        = $conn->query ( $sql2 );
$total_packages = 0;
if ( $result2->num_rows > 0 )
     {
     $row            = $result2->fetch_assoc ();
     $total_packages = $row[ 'total_packages' ];
     }

// Query to get the total number of inquiries
$sql3            = "SELECT COUNT(*) AS total_inquiries FROM inquiries";
$result3         = $conn->query ( $sql3 );
$total_inquiries = 0;
if ( $result3->num_rows > 0 )
     {
     $row             = $result3->fetch_assoc ();
     $total_inquiries = $row[ 'total_inquiries' ];
     }

// Query to get the total number of bookings
$sql4           = "SELECT COUNT(*) AS total_bookings FROM bookings";
$result4        = $conn->query ( $sql4 );
$total_bookings = 0;
if ( $result4->num_rows > 0 )
     {
     $row            = $result4->fetch_assoc ();
     $total_bookings = $row[ 'total_bookings' ];
     }

$conn->close ();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Home</title>
</head>

<body>
     <div class="dashboard-container">
          <div class="dashboard-card">
               <h3>Total Users</h3>
               <p><?= $total_users > 0 ? $total_users : "0" ?></p>
               <a href="admin_dashboard.php?tab=manage_users">Manage Users</a>
          </div>
          <div class="dashboard-card">
               <h3>Total Packages</h3>
               <p><?= $total_packages > 0 ? $total_packages : "0" ?></p>
               <a href="admin_dashboard.php?tab=manage_packages">Manage Packages</a>
          </div>
          <div class="dashboard-card">
               <h3>Total Inquiries</h3>
               <p><?= $total_inquiries > 0 ? $total_inquiries : "0" ?></p>
               <a href="admin_dashboard.php?tab=manage_inquiries">Manage Inquiries</a>
          </div>
          <div class="dashboard-card">
               <h3>Total Issues</h3>
               <p><?= $total_issues > 0 ? $total_issues : "0" ?></p>
               <a href="admin_dashboard.php?tab=manage_issues">Manage Issues</a>
          </div>
          <div class="dashboard-card">
               <h3>Total Bookings</h3>
               <p><?= $total_bookings > 0 ? $total_bookings : "0" ?></p>
               <a href="admin_dashboard.php?tab=manage_booking">Manage Booking</a>
          </div>
          <div class="dashboard-card">
               <h3>Reports</h3>
               <p>View and generate reports</p>
               <a href="admin_dashboard.php?tab=reports">View Reports</a>
          </div>
     </div>
</body>

</html>