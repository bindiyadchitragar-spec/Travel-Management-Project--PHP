<?php
session_start ();

if ( ! isset ( $_SESSION[ 'user_id' ] ) || $_SESSION[ 'role' ] !== 'admin' )
     {
     header ( "Location: login.php" );
     exit ();
     }

$tab = isset ( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'home';

function setActiveClass ( $currentTab, $tabName )
     {
     return $currentTab === $tabName ? 'active' : '';
     }
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Dashboard</title>
     <link rel="stylesheet" href="styles/responsive.css?v=<?= time (); ?>">
     <link rel="icon" href="styles/images/logo.jpg" type="image/jpg">
</head>

<body>
     <header>
          <div class="logo-container">
               <img src="styles/images/logo.jpg" alt="Logo" class="logo">
          </div>
          <nav>
               <ul>
                    <li><a class="<?= setActiveClass ( $tab, 'home' ) ?>" href="admin_dashboard.php?tab=home">Home</a>
                    </li>
                    <li><a class="<?= setActiveClass ( $tab, 'manage_users' ) ?>"
                              href="admin_dashboard.php?tab=manage_users">Manage Users</a></li>
                    <li><a class="<?= setActiveClass ( $tab, 'manage_packages' ) ?>"
                              href="admin_dashboard.php?tab=manage_packages">Manage Packages</a></li>
                    <li><a class="<?= setActiveClass ( $tab, 'manage_inquiries' ) ?>"
                              href="admin_dashboard.php?tab=manage_inquiries">Manage Inquiries</a></li>
                    <li><a class="<?= setActiveClass ( $tab, 'manage_issues' ) ?>"
                              href="admin_dashboard.php?tab=manage_issues">Manage Issues</a></li>
                    <li><a class="<?= setActiveClass ( $tab, 'manage_booking' ) ?>"
                              href="admin_dashboard.php?tab=manage_booking">Manage Booking</a></li>
                    <li><a href="logout.php">Logout</a></li>
               </ul>
          </nav>
     </header>
     <div class="content">
          <?php
          switch ( $tab )
               {
               case 'manage_users':
                    include 'admin_manage_users.php';
                    break;
               case 'manage_packages':
                    include 'admin_manage_packages.php';
                    break;
               case 'manage_inquiries':
                    include 'admin_manage_inquiries.php';
                    break;
               case 'manage_issues':
                    include 'admin_manage_issues.php';
                    break;
               case 'manage_booking':
                    include 'admin_manage_booking.php';
                    break;
               default:
                    include 'admin_home.php';
                    break;
               }
          ?>
     </div>
     <?php include 'assets/footer.php'; ?>
</body>

</html>