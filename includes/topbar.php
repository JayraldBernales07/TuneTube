<header class="d-flex justify-content-between align-items-center p-3 bg-black text-white">
    <nav>
        <a href="#" class="text-gray me-3 text-decoration-none">Music</a>
        <a href="#" class="text-gray me-3 text-decoration-none">Live</a>
        <a href="#" class="text-gray text-decoration-none">Podcast</a>
    </nav>
    
     <!-- Search bar -->
    <div class="search">
        <i class='bx bx-search'></i>
        <form action="search-result.php" method="GET">
            <input type="text" name="search" placeholder="Search songs..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"autocomplete="off">
        </form>
    </div>


    <div class="profile d-flex align-items-center">
        <!-- Profile Section -->
        <div class="profile">
          <!-- Settings Icon -->
          <button class="icon-btn">
            <i class='bx bxs-bell me-3'></i>
            <i class='bx bxs-cog'></i>
          </button>

          <!-- User Profile Section -->
          <div class="user">
            <!-- Profile Picture -->
            <div class="left">
              <img src="admin/img/profile.png" alt="Profile Picture" class="rounded-circle">
            </div>

            <!-- Right Side with Logout -->
            <div class="right">
              <a href="admin/logout.php" data-bs-toggle="modal" data-bs-target="#logoutModal" class="logout-btn text-decoration-none">Log out</a>
            </div>
          </div>
        </div>
    </div>

</header>

<!-- Confirmation Modal for Log out -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Confirm Log Out</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        Are you sure you want to log out?
      </div>
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="admin/logout.php" class="btn btn-danger">Log out</a>
      </div>
    </div>
  </div>
</div>

