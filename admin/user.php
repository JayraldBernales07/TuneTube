<?php
include('../security.php'); 
include('includes/header.php'); 

// Handle form submissions for Create and Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        // Create User
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
        $email = $_POST['email'];
        $role = $_POST['role'];

        $stmt = $connection->prepare("INSERT INTO users (Username, Password, Email, Role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $email, $role);
        $stmt->execute();
    } elseif (isset($_POST['update'])) {
        // Update User
        $id = $_POST['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        
        // Only update the password if it's provided
        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt = $connection->prepare("UPDATE users SET Username=?, Email=?, Role=?, Password=? WHERE UserID=?");
            $stmt->bind_param("ssssi", $username, $email, $role, $password, $id);
        } else {
            $stmt = $connection->prepare("UPDATE users SET Username=?, Email=?, Role=? WHERE UserID=?");
            $stmt->bind_param("sssi", $username, $email, $role, $id);
        }
        $stmt->execute();
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $connection->prepare("DELETE FROM users WHERE UserID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Fetch Users
$result = $connection->query("SELECT * FROM users");
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar-user.php'; ?> 

        <div class="col-md-10 position-relative">
            <?php include 'includes/topbar.php'; ?> 

            <main class="row">
                <section class="col-md-8 p-4">
                    <div class="music-list-container p-3 mt-3 text-white rounded">
    
                        <h3>User Management</h3>
                        <div class="music-list overflow-auto" style="max-height: 480px;">
                            <div class="items">
                                <!-- User Table -->
                                <table class="table table-borderless table-hover">
                                    <thead class="table-borderless text-light">
                                        <tr>
                                            <th scope="col">Profile</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-light">
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <th scope="row"><img src='img/th.jpg' class='img-fluid rounded' style='width: 40px; height: 40px;'></th>
                                                <td><?php echo htmlspecialchars($row['Username']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                                <td><?php echo htmlspecialchars($row['Role']); ?></td>
                                                <td>
                                                    <button class="btn btn-info" onclick="editUser(<?php echo $row['UserID']; ?>, '<?php echo addslashes($row['Username']); ?>', '<?php echo addslashes($row['Email']); ?>', '<?php echo $row['Role']; ?>')">Edit</button>
                                                    <a href="?delete=<?php echo $row['UserID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>    
                        </div>    
                    </div>    
                </section>
            </main>

            <!-- Update User -->
            <aside class="user-section col-md-4 p-3 text-white position-absolute end-0">
                    <!-- Create User Form -->
                <h3>Create New User</h3>
                <p class="spacing mt-4 mb-4"></p> <!-- For spacing -->
                    <form method="POST" class="mb-4" id="userForm">
                        <input type="hidden" name="id" id="userId">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <small class="form-text txt">Leave blank to keep the current password.</small>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role" id="role" required>
                                <option value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" name="create" class="btn btn-primary mt-4" id="addUserBtn">Add User</button>
                        <button type="button" class="btn btn-secondary mt-4" id="cancelBtn" style="display: none;" onclick="cancelEdit()">Cancel</button>
                        <button type="submit" name="update" class="btn btn-warning mt-4" id="updateUserBtn" style="display: none;">Update User</button>
                    </form>
            </aside>

        </div>
    </div>
</div>

<?php include 'includes/scripts.php'; ?>

<script>
function editUser(id, username, email, role) {
    document.getElementById('userId').value = id;
    document.getElementById('username').value = username;
    document.getElementById('email').value = email;
    document.getElementById('role').value = role;
    document.getElementById('password').value = ''; // Clear password field
    
    // Hide "Add User" button and show "Update User" button
    document.getElementById('addUserBtn').style.display = 'none';
    document.getElementById('updateUserBtn').style.display = 'inline-block';
    document.getElementById('cancelBtn').style.display = 'inline-block';
}

function cancelEdit() {
    // Reset the form and hide the "Update User" button, show "Add User" button
    document.getElementById('userForm').reset();
    document.getElementById('addUserBtn').style.display = 'inline-block';
    document.getElementById('updateUserBtn').style.display = 'none';
    document.getElementById('cancelBtn').style.display = 'none';
}
</script>

<style>
.txt {
    color: #919191;
}
.user-section {
    background-color: #202026; /* Darker background */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
    margin-right: 22px;
    top: 120px;
    width: 400px;
    color: white; /* Ensure text is white for visibility */
}
.table {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
}
.table th, .table td {
    text-align: center;
    vertical-align: middle;
}
.table-hover tbody tr:hover td, 
.table-hover tbody tr:hover th {
    background-color: #18181d;
    color: white !important;
}
.table-dark {
    background-color: #343a40;
    color: white;
}
.btn-sm {
    padding: 5px 10px;
    font-size: 0.9rem;
}
.btn {
    border-radius: 5px;
    margin-left:10px;
}
h3 {
    color: white;
    font-weight: bold;
    margin-bottom:25px;
}
</style>

