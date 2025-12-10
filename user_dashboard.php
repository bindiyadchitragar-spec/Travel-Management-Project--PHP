<?php
session_start ();

// Check if the user is logged in and has the 'user' role
if ( ! isset ( $_SESSION[ 'user_id' ] ) || $_SESSION[ 'role' ] !== 'user' )
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
     <title>User Dashboard</title>
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
                    <li><a class="<?= setActiveClass ( $tab, 'home' ) ?>" href="user_dashboard.php?tab=home">Home</a>
                    </li>
                    <li><a class="<?= setActiveClass ( $tab, 'my_bookings' ) ?>"
                              href="user_dashboard.php?tab=my_bookings">My Bookings</a></li>
                    <li><a class="<?= setActiveClass ( $tab, 'profile' ) ?>"
                              href="user_dashboard.php?tab=profile">Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
               </ul>
          </nav>
     </header>
     <div class="content">
          <?php
          switch ( $tab )
               {
               case 'my_bookings':
                    include 'user_bookings.php';
                    break;
               case 'profile':
                    include 'user_profile.php';
                    break;
               default:
                    include 'user_home.php';
                    break;
               }
          ?>
     </div>
     <?php include 'assets/footer.php'; ?>
</body>

</html>