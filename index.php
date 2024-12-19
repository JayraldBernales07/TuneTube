<?php
session_start(); // Start the session at the beginning of the file
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE-edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TuneTube | Music Player Platform</title>
   <link rel="stylesheet" href="admin/css/login.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
   <header class="header">
      <nav class="navbar">
         <a href="#">Home</a>
         <a href="#">About</a>
         <a href="#">Services</a>
         <a href="#">Contact</a>
      </nav>

      <form action="#" class="search-bar">
         <input type="text" placeholder="Search...">
         <button type="submit"><i class='bx bx-search'></i></button>
      </form>
   </header>

   <div class="background"></div>
   <div class="container">
      <div class="content">
         <h2 class="logo">
            <i class='bx bx-pulse'></i>TuneTube</h2>

         <div class="text-sci">
            <h2>Welcome!<br><span>Your ultimate music player platform.</span></h2>

            <p>Dive into a symphony of melodies that are not just memorable but enchanting. Let the music sweep you away!</p>

            <div class="social-icons">
               <a href="#"><i class='bx bxl-linkedin'></i></a>
               <a href="#"><i class='bx bxl-facebook'></i></a>
               <a href="#"><i class='bx bxl-instagram'></i></a>
               <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
         </div>
      </div>

      <div class="logreg-box">
         <div class="form-box login">
            <form action="admin/code.php" method="POST">
               <h2>Sign In</h2>

               <div class="input-box">
                  <span class="icon"><i class='bx bxs-envelope'></i></span>
                  <input type="email" name="Email" required>
                  <label>Email</label>
               </div>

               <div class="input-box">
                  <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                  <input type="password" name="Password" required>
                  <label>Password</label>
               </div>



               <div class="remember-forgot">
                  <label><input type="checkbox">Remember me</label>
                  <a href="#">Forgot password</a>
               </div>
               <?php
                // Check if there's a status message in the session and display it
                if (isset($_SESSION['status'])) {
                    // Check if the status indicates success or error
                    if ($_SESSION['status_type'] == 'success') {
                        // Success message, display in green
                        echo '<p class="success-message" style="color: green; margin-bottom: 15px; font-weight: 500;">' . $_SESSION['status'] . '</p>';
                    } else {
                        // Error message, display in red
                        echo '<p class="error-message" style="color: red;">' . $_SESSION['status'] . '</p>';
                    }
                    unset($_SESSION['status']);  // Clear the status message after displaying it
                    unset($_SESSION['status_type']);  // Clear the status type
                }
               ?>
               <button type="submit" name="login_btn" class="btn">Sign In</button>

               <div class="login-register">
                  <p>Don't have an account? <a href="#" class="register-link">Sign up</a></p>
               </div>
            </form>
         </div>

         <div class="form-box register">
            <form action="register_code.php" method="POST">
               <h2>Sign Up</h2>

               <div class="input-box">
                  <span class="icon"><i class='bx bxs-user'></i></span>
                  <input type="text" name="Username" required>
                  <label>Username</label>
               </div>

               <div class="input-box">
                  <span class="icon"><i class='bx bxs-envelope'></i></span>
                  <input type="email" name="Email" required>
                  <label>Email</label>
               </div>

               <div class="input-box">
                  <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                  <input type="password" name="Password" required>
                  <label>Password</label>
               </div>
               <div class="input-box">
                  <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                  <input type="password" name="ConfirmPassword" required>
                  <label> Confirm Password</label>
               </div>
               <div class="remember-forgot">
                  <label><input type="checkbox">I agree to the terms & conditions</label>
               </div>
               <?php
                // Check if there's a status message in the session and display it
                if (isset($_SESSION['status'])) {
                    // Check if the status indicates success or error
                    if ($_SESSION['status_type'] == 'success') {
                        // Success message, display in green
                        echo '<p class="success-message" style="color: green; margin-bottom: 15px; font-weight: 500;">' . $_SESSION['status'] . '</p>';
                    } else {
                        // Error message, display in red
                        echo '<p class="error-message" style="color: red;">' . $_SESSION['status'] . '</p>';
                    }
                    unset($_SESSION['status']);  // Clear the status message after displaying it
                    unset($_SESSION['status_type']);  // Clear the status type
                }
               ?>
               <button type="submit" name="register_btn" class="btn">Sign Up</button>

               <div class="login-register">
                  <p>Already have an account? <a href="#" class="login-link">Sign in</a></p>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script src="admin/js/login.js"></script>
</body>

</html>