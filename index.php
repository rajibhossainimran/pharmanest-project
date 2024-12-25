
<?php 
    session_start();
     //   include('/asstes/images/login_background.avif');
     $img = './asstes/images/login-bg.png';
     $logo = './asstes/images/Pharmanest1.png';
     $background = './asstes/images/login-background.jpg';
    // include database and set connection 
    include_once "./config/config.php";
    $db = mysqli_connect($localhost, $username, $password, $dbname);
    if(! $db){
        throw new Exception('Database connection failed: ' . mysqli_connect_error());
    }

    // when signin button click then check email and password in database 
    if (isset($_POST['btnLogin'])) {
        // Retrieve form data and sanitize inputs
        $role = mysqli_real_escape_string($db, $_POST['user-roll']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
    
        // Check if all required fields are provided
        if ($email && $password && $role) {
            $query = "SELECT * FROM {$role} WHERE email='{$email}' AND password='{$password}'LIMIT 1";
            $user_result = mysqli_query($db, $query);
    
            // Check if query was successful and if data exists
            if ($user_result && mysqli_num_rows($user_result) > 0) {
                $user = mysqli_fetch_assoc($user_result); // Fetch user data
    
                // Store user data in session
                $_SESSION['role'] = $role;
                // $_SESSION['id'] = $user['id']; // Assuming your table has an 'id' column
    
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit(); // Ensure no further code executes
            } else {
                // Invalid login credentials
                $msg = "Invalid email, password, or role.";
            }
        } else {
            $msg = "Please fill in all required fields.";
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/png" href="./asstes/images/Pharmanest (1).png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="./bootstrap/css/adminlte.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('<?php echo $background; ?>') no-repeat center center/cover;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 450px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <div class="text-center mb-4">
                <img src="<?php echo $logo; ?>" alt="logo" class="img-fluid" style="max-width: 200px;">
            </div>

            <!-- Role Selection -->
            <div class="mb-3">
                <label for="user-roll" class="form-label">Select Role</label>
                <select name="user-roll" id="user-roll" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="salesman">Salesman</option>
                </select>
            </div>

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="rajib@gmail.com" required>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="rajib" required>
            </div>

            <!-- Error Message Display -->
            <?php if (isset($msg)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" name="btnLogin" class="btn btn-primary">Sign In</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="./bootstrap/js/adminlte.min.js"></script>
</body>
</html>
