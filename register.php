<?php
session_start(); // Start PHP session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection parameters
  $servername = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $dbname = "vrs"; 

  // Create connection
  
  $conn= new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Function to generate a new customer ID
  function generateCustomerID($db) {
    $query = "SELECT MAX(uid) AS last_id FROM customer";
    $result = mysqli_query($db, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $lastID = $row['last_id'];

        // Extract the numeric part from the last ID
        $numericPart = intval(substr($lastID, 4));
        
        // Increment the numeric part
        $newNumericPart = $numericPart + 1;
        
        // Format the new ID with leading zeros
        $newID = 'CUST' . sprintf('%03d', $newNumericPart);
        
        return $newID;
    } else {
        // If no records found, start from CUST001
        return 'CUST001';
    }
}

  // Get user input (email and password) and sanitize them
  $id = generateCustomerID($conn);
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $passwd = $_POST['passwd']; // hash the password before storing it in the database
  echo $email;
  echo $passwd;
  echo $id;

  // SQL query to insert new user into database
  $sql = "INSERT INTO customer (uid,name,email, pswd,ph_no,address) VALUES (?, ?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssss", $id, $name, $email, $passwd, $phone, $address);

  if ($stmt->execute()) {
    // Registration successful, set session variables
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;

    // Redirect to a secure page after successful registration
    header("Location: index.php");
    exit();
  } else {
    // Registration failed, display an error message
    $error = "Registration failed";
  }

  // Close database connection
  $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <!-- ** Basic Page Needs ** -->
  <meta charset="utf-8">
  <title>VRS</title>

  <!-- ** Mobile Specific Metas ** -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Agency HTML Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Classified Marketplace Template v1.0">

  <!-- theme meta -->
  <meta name="theme-name" content="classimax" />

  <!-- favicon -->
  <!-- <link href="images/favicon.png" rel="shortcut icon"> -->

  <!-- 
  Essential stylesheets
  =====================================-->
  <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="plugins/slick/slick.css" rel="stylesheet">
  <link href="plugins/slick/slick-theme.css" rel="stylesheet">
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

</head>

<body class="body-wrapper">


  <!--Header-->
  <?php include ('header.php'); ?>
  <!-- /Header -->

  <section class="login py-5 border-top-1">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 align-item-center">
          <div class="border border">
            <h3 class="bg-gray p-4">Register Now</h3>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
              <fieldset class="p-4">
                <input class="form-control mb-3" type="text" name="name" placeholder="Full Name*" required>
                <input class="form-control mb-3" type="email" name="email" placeholder="Email*" required>
                <input class="form-control mb-3" type="password" name="passwd" placeholder="Password*" required>
                <input class="form-control mb-3" type="password" name="cpasswd" placeholder="Confirm Password*"
                  required>
                <input class="form-control mb-3" type="text" name="phone" placeholder="Phone Number*" required>
                <input class="form-control mb-3" type="text" name="address" placeholder="Address*" required>
                <div class="loggedin-forgot d-inline-flex my-3">
                  <input type="checkbox" id="registering" class="mt-1">
                  <label for="registering" class="px-2">By registering, you accept our <a
                      class="text-primary font-weight-bold" href="terms-condition.html">Terms & Conditions</a></label>
                </div>
                <button type="submit" class="btn btn-primary font-weight-bold mt-3">Register Now</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ========================================== -->
  <!-- Footer -->
  <?php include ('footer.php'); ?>


  <!-- 
Essential Scripts
=====================================-->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/popper.min.js"></script>
  <script src="plugins/bootstrap/bootstrap.min.js"></script>
  <script src="plugins/bootstrap/bootstrap-slider.js"></script>
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/slick/slick.min.js"></script>
  <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>

  <!-- google map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
  <script src="plugins/google-map/map.js" defer></script>

  <script src="js/script.js"></script>

</body>

</html>