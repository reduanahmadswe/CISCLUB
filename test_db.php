<?php
require_once __DIR__ . '/config/config.php';

echo "<h2>Database Connection Test</h2>";

// Test 1: Check admin users
echo "<h3>Admin Users:</h3>";
$admin_query = "SELECT id, full_name, username, password FROM admin_users";
$admin_result = db_query($admin_query);

if ($admin_result) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Password</th></tr>";
    while ($row = db_fetch($admin_result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Error: " . mysqli_error($GLOBALS['conn']);
}

// Test 2: Check regular users
echo "<br><h3>Regular Users:</h3>";
$users_query = "SELECT id, full_name, username, email, status FROM users";
$users_result = db_query($users_query);

if ($users_result) {
    if (mysqli_num_rows($users_result) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Name</th><th>Username</th><th>Email</th><th>Status</th></tr>";
        while ($row = db_fetch($users_result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['full_name'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No regular users found.";
    }
} else {
    echo "Error: " . mysqli_error($GLOBALS['conn']);
}

// Test 3: Create a test user if none exists
echo "<br><h3>Create Test User:</h3>";
$check_user = "SELECT id FROM users WHERE username = 'testuser'";
$check_result = db_query($check_user);

if (mysqli_num_rows($check_result) == 0) {
    $hashed_password = password_hash('test123', PASSWORD_DEFAULT);
    $insert_user = "INSERT INTO users (full_name, email, username, password, phone, student_id, status) 
                    VALUES ('Test User', 'test@example.com', 'testuser', '$hashed_password', '01700000000', '201-15-0000', 'active')";
    
    if (db_query($insert_user)) {
        echo "✅ Test user created successfully!<br>";
        echo "Username: <strong>testuser</strong><br>";
        echo "Password: <strong>test123</strong>";
    } else {
        echo "Error creating test user: " . mysqli_error($GLOBALS['conn']);
    }
} else {
    echo "Test user already exists.<br>";
    echo "Username: <strong>testuser</strong><br>";
    echo "Password: <strong>test123</strong>";
}

echo "<br><br><hr>";
echo "<h3>Instructions:</h3>";
echo "<ul>";
echo "<li><strong>For User Login:</strong> Go to <a href='" . SITE_URL . "/auth/login.php'>User Login</a> - Use username: <strong>testuser</strong>, password: <strong>test123</strong></li>";
echo "<li><strong>For Admin Login:</strong> Go to <a href='" . ADMIN_URL . "/login.php'>Admin Login</a> - Use username: <strong>admin</strong>, password: <strong>admin123</strong></li>";
echo "</ul>";
?>
