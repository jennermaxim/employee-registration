<?php
session_start();
session_destroy();

include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>NWIR |Login & Registration</title>
</head>

<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <p>NWIR .</p>
            </div>
            <div class="nav-menu" id="navMneu">
                <ul>
                    <li><a href="#" class="link active">Home</a></li>
                    <li><a href="#" class="link">Blog</a></li>
                    <li><a href="#" class="link">Services</a></li>
                    <li><a href="#" class="link">About</a></li>
                </ul>
            </div>
            <div class="nav-button">
                <button class="btn white-btn" id="loginBtn" onclick="login()">
                    <a href="index.php">Sign In</a>
                </button>
                <button class="btn" id="registerBtn" onclick="register()">
                    <a href="register.php"> Sign Up</a>
                </button>
            </div>
            <div class="nav-menu-btn">
                <i class="bx bx- menu" onclick="myMenuFunction"></i>
            </div>
        </nav>
        <div class="form-box">
            <div class="login-container" id="login">
                <div class="top">
                    <span>Already have an account?
                        <a href="index.php" onclick="register()">Sign In</a></span>
                    <header>Login</header>
                </div>
                <?php
                if (isset($_POST['register'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];
                    $address = $_POST['address'];
                    $company = $_POST['company'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];

                    if ($password === $cpassword) {
                        $query = "SELECT * FROM tbl_admin WHERE email = '$email'";
                        $select = mysqli_query($conn, $query);
                        if (mysqli_num_rows($select) > 0) {
                            echo "<div style='color: red;'>Acount already exist</div>";
                        } else {
                            $query = "INSERT 
                            INTO tbl_admin(`name`, email, contact, `address`, company, `password`)
                            VALUES ('$name', '$email', '$contact', '$address', '$company', '$password')";
                            $insert = mysqli_query($conn, $query);
                            if ($insert) {
                                session_start();
                                $_SESSION['email'] = $email;
                                header("Location:dashboard.php");
                            } else {
                                echo "<div style='color: red;'>Error, failed to create your account, please try again</div>";
                            }
                        }
                    } else {
                        echo "<div style='color: red;'>Error, password do not match!</div>";
                    }

                }
                ?>
                <form method="post">
                    <div class="input-box">
                        <input type="text" name="name" class="input-field" placeholder="Name" required />
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" class="input-field" placeholder="Email" required />
                    </div>
                    <div class="input-box">
                        <input type="text" name="contact" class="input-field" placeholder="Phone Number" required />
                    </div>
                    <div class="input-box">
                        <input type="text" name="address" class="input-field" placeholder="Address" required />
                    </div>
                    <div class="input-box">
                        <input type="text" name="company" class="input-field" placeholder="Company Name" required />
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input-field" placeholder="Password" required />
                    </div>
                    <div class="input-box">
                        <input type="password" name="cpassword" class="input-field" placeholder="Confirm Password" required />
                    </div>
                    <div class="input-box">
                        <input type="submit" name="register" class="submit" value="Sign In" />
                    </div>
                </form>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check" />
                        <label for="login-check">Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function myMenuFunction() {
                var i = document.getElementById("navMenu");

                if (i.className === "nav-menu") {
                    i.className += "responsive";
                } else {
                    i.className = "nav-menu";
                }
            }

            var a = document.getElementById("loginBtn");
            var b = document.getElementById("registerBtn");
            var x = document.getElementById("login");
            var y = document.getElementById("register");

            function login() {
                x.xtyle.left = "4px";
                y.style.right = "-520px";
                a.className += "white-btn";
                b.className = "btn";
                x.xtyle.opacity = 1;
                y.style.opacity = 0;
            }
            function register() {
                x.style.left = "510px";
                y.style.right = "5px";
                a.className = "btn";
                b.className += "white-btn";
                x.xtyle.opacity = 0;
                y.style.opacity = 1;
            }
        </script>
    </div>
</body>

</html>