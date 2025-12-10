<?php
include 'config.php';

// Initialize variables
$packages         = [];
$package_name     = $package_description = $package_price = "";
$package_name_err = $package_description_err = $package_price_err = "";

// Fetch all packages from the database
$sql    = "SELECT * FROM packages";
$result = $conn->query ( $sql );

if ( $result->num_rows > 0 )
     {
     while ( $row = $result->fetch_assoc () )
          {
          $packages[] = $row;
          }
     }

// Handle package addition
if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" && isset ( $_POST[ 'add_package' ] ) )
     {
     // Validate package name
     if ( empty ( trim ( $_POST[ "package_name" ] ) ) )
          {
          $package_name_err = "Please enter the package name.";
          }
     else
          {
          $package_name = trim ( $_POST[ "package_name" ] );
          }

     // Validate package description
     if ( empty ( trim ( $_POST[ "package_description" ] ) ) )
          {
          $package_description_err = "Please enter a description.";
          }
     else
          {
          $package_description = trim ( $_POST[ "package_description" ] );
          }

     // Validate package price
     if ( empty ( trim ( $_POST[ "package_price" ] ) ) || ! is_numeric ( trim ( $_POST[ "package_price" ] ) ) )
          {
          $package_price_err = "Please enter a valid price.";
          }
     else
          {
          $package_price = trim ( $_POST[ "package_price" ] );
          }

     // Check input errors before inserting in the database
     if ( empty ( $package_name_err ) && empty ( $package_description_err ) && empty ( $package_price_err ) )
          {
          // Prepare an insert statement
          $sql = "INSERT INTO packages (name, description, price) VALUES (?, ?, ?)";

          if ( $stmt = $conn->prepare ( $sql ) )
               {
               // Bind variables to the prepared statement
               $stmt->bind_param ( "ssd", $param_name, $param_description, $param_price );

               // Set parameters
               $param_name        = $package_name;
               $param_description = $package_description;
               $param_price       = $package_price;

               // Attempt to execute the statement
               if ( $stmt->execute () )
                    {
                    // Redirect to the same page to refresh the package list
                    header ( "location: admin_manage_packages.php" );
                    exit ();
                    }
               else
                    {
                    echo "Oops! Something went wrong. Please try again later.";
                    }

               // Close statement
               $stmt->close ();
               }
          }
     }

// Handle package deletion
if ( isset ( $_GET[ 'delete_id' ] ) )
     {
     $delete_id = intval ( $_GET[ 'delete_id' ] );

     // Prepare a delete statement
     $sql = "DELETE FROM packages WHERE id = ?";

     if ( $stmt = $conn->prepare ( $sql ) )
          {
          // Bind variables to the prepared statement
          $stmt->bind_param ( "i", $param_id );

          // Set parameters
          $param_id = $delete_id;

          // Attempt to execute the statement
          if ( $stmt->execute () )
               {
               // Redirect to the same page to refresh the package list
               header ( "location: admin_manage_packages.php" );
               exit ();
               }
          else
               {
               echo "Oops! Something went wrong. Please try again later.";
               }

          // Close statement
          $stmt->close ();
          }
     }

// Handle package editing
if ( isset ( $_POST[ 'edit_package' ] ) )
     {
     $edit_id          = intval ( $_POST[ 'edit_id' ] );
     $edit_name        = trim ( $_POST[ 'edit_name' ] );
     $edit_description = trim ( $_POST[ 'edit_description' ] );
     $edit_price       = trim ( $_POST[ 'edit_price' ] );

     if ( ! empty ( $edit_name ) && ! empty ( $edit_description ) && ! empty ( $edit_price ) && is_numeric ( $edit_price ) )
          {
          // Prepare an update statement
          $sql = "UPDATE packages SET name = ?, description = ?, price = ? WHERE id = ?";

          if ( $stmt = $conn->prepare ( $sql ) )
               {
               // Bind variables to the prepared statement
               $stmt->bind_param ( "ssdi", $param_name, $param_description, $param_price, $param_id );

               // Set parameters
               $param_name        = $edit_name;
               $param_description = $edit_description;
               $param_price       = $edit_price;
               $param_id          = $edit_id;

               // Attempt to execute the statement
               if ( $stmt->execute () )
                    {
                    // Redirect to the same page to refresh the package list
                    header ( "location: admin_manage_packages.php" );
                    exit ();
                    }
               else
                    {
                    echo "Oops! Something went wrong. Please try again later.";
                    }

               // Close statement
               $stmt->close ();
               }
          }
     }

$conn->close ();
?>


<div class="packages-container">
     <h1>Manage Packages</h1>
     <!-- Add Package Form -->
     <div class="packages-box">
          <div class="add-form">
               <h2>Add New Package</h2>
               <form action="<?php echo htmlspecialchars ( $_SERVER[ "PHP_SELF" ] ); ?>" method="post">
                    <div class="form-group">
                         <input type="text" placeholder="Package Name" id="package_name" name="package_name"
                              value="<?php echo htmlspecialchars ( $package_name ); ?>">
                         <span class="error"><?php echo $package_name_err; ?></span>
                    </div>
                    <div class="form-group">
                         <textarea id="package_description" placeholder="Package Description"
                              name="package_description"><?php echo htmlspecialchars ( $package_description ); ?></textarea>
                         <span class="error"><?php echo $package_description_err; ?></span>
                    </div>
                    <div class="form-group">
                         <input type="text" placeholder="Package Price" id="package_price" name="package_price"
                              value="<?php echo htmlspecialchars ( $package_price ); ?>">
                         <span class="error"><?php echo $package_price_err; ?></span>
                    </div>
                    <div class="form-group">
                         <button type="submit" name="add_package">Add Package</button>
                    </div>
               </form>
          </div>

          <!-- Display Packages -->
          <h2>Existing Packages</h2>
          <table>
               <thead>
                    <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Description</th>
                         <th>Price</th>
                         <th>Actions</th>
                    </tr>
               </thead>
               <tbody>
                    <?php foreach ( $packages as $package ) : ?>
                    <tr>
                         <td><?php echo htmlspecialchars ( $package[ 'id' ] ); ?></td>
                         <td><?php echo htmlspecialchars ( $package[ 'name' ] ); ?></td>
                         <td><?php echo htmlspecialchars ( $package[ 'description' ] ); ?></td>
                         <td>Rs.<?php echo htmlspecialchars ( $package[ 'price' ] ); ?></td>
                         <td>
                              <form action="admin_edit_package.php" method="get" style="display:inline;">
                                   <input type="hidden" name="id"
                                        value="<?php echo htmlspecialchars ( $package[ 'id' ] ); ?>">
                                   <button type="submit">Edit</button>
                              </form>
                              <form action="<?php echo htmlspecialchars ( $_SERVER[ "PHP_SELF" ] ); ?>" method="get"
                                   style="display:inline;">
                                   <input type="hidden" name="delete_id"
                                        value="<?php echo htmlspecialchars ( $package[ 'id' ] ); ?>">
                                   <button type="submit" class="delete-button">Delete</button>
                              </form>
                         </td>
                    </tr>
                    <?php endforeach; ?>
               </tbody>
          </table>
     </div>
</div>