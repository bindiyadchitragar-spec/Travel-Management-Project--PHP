<?php
include 'config.php';

// Query to get all packages
$sql    = "SELECT * FROM packages";
$result = $conn->query ( $sql );

?>

<div class="content">
     <div class="packages-container">
          <?php if ( $result->num_rows > 0 ) : ?>
          <?php while ( $row = $result->fetch_assoc () ) : ?>
          <div class="package-card">
               <div class="package-content">
                    <h3 class="package-title"><?= htmlspecialchars ( $row[ 'name' ] ) ?></h3>
                    <p class="package-description"><?= htmlspecialchars ( $row[ 'description' ] ) ?></p>
                    <p class="package-price">$<?= htmlspecialchars ( number_format ( $row[ 'price' ], 2 ) ) ?></p>
                    <a href="user_book.php?package_id=<?= $row[ 'id' ] ?>" class="book-button">Book Now</a>
               </div>
          </div>
          <?php endwhile; ?>
          <?php else : ?>
          <p>No packages available at the moment.</p>
          <?php endif; ?>
     </div>
</div>