<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/6fae70d273.js" crossorigin="anonymous"></script>
</head>

<body class="login_bg">
    <?php
    session_start();
    include('DB/conn.php');

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE user_email = $email AND user_password = $password";

        $result = mysqli_query($connect, $query);

        if ($result) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_email'] = $user['user_email'];
                header("Location:/pages/category_list.php");
                exit();
            } else {
                $error = "Invalid email or password!";
            }
        } else {
            $error = "Invalid email or password!";
        }
    }
    ?>
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="text-center p-5">
            <img src="assets/images/Logo.png" alt="Logo" class="img-fluid logo">
            <div class="shadow-lg bg-white login_box p-5">
                <h3 class="mb-4">Sign in</h3>
                <form action="login.php" method="post">

                    <div class="mb-3">
                        <label for="email" class="form-label float-start">Email address</label>
                        <input type="email" class="form-control inp" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label float-start">Password</label>
                        <a href="#" class="link-primary float-end text-decoration-none">Forgot Password?</a>
                        <div class="input-group">
                            <input type="password" class="form-control inp" name="password" placeholder="Enter your password" required>
                            <span class="input-group-text password-toggle" id="togglePassword">
                                <i class="fa-regular fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success w-100 mt-2 inp" name="login" value="Login">
                </form>
            </div>
        </div>
    </div>

</body>

</html>