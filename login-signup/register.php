<?php
session_start();
if(isset($_SESSION['id'])){
    header('Location: index.php');
    exit();
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <div class="m-auto w-50 p-3 bg-light mt-5">

        <?php

        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['submit'])) {
                $fname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $cnfpassword = $_POST['confirm_password'];

                $err = array();

                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                if (empty($fname) || empty($email) || empty($password)) {
                    array_push($err,'All fields are required.');
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($err,'Invalid email format.');
                }

                if (strlen($password) < 8) {
                    array_push($err,'Password must be at least 8 characters long.');
                }

                if ($password != $cnfpassword) {
                    array_push($err,'Passwords do not match.');
                }

                if(count($err) > 0){
                    foreach($err as $error){
                         echo "<div class='alert alert-danger' role='alert'>
                                $error
                            </div>";
                    }
                }else{
                      require_once 'database.php';

                $checkQuery = "select * from users where email = '$email'";
                $res = mysqli_query($conn, $checkQuery);

                if (mysqli_num_rows($res) > 0) {
                    echo '<div class="alert alert-danger" role="alert">
                        Email already exist.
                    </div>';
                }else{

                    $insertQuery = "insert into users (fullName, email, password) values (?,?,?)";
    
                    $stmt = mysqli_stmt_init($conn);
                    $preparestmt = mysqli_stmt_prepare($stmt, $insertQuery);
    
                    if ($preparestmt) {
                        mysqli_stmt_bind_param($stmt, 'sss', $fname, $email, $hashPassword);
                        mysqli_stmt_execute($stmt);
                        echo '<div class="alert alert-success" role="alert">
                                    Resgistered Successfully.
                                </div>';
                                header('Location: login.php');
                    } else {
                        die('<div class="alert alert-danger" role="alert">
                                Failed to Registered.
                            </div>');
                    }
                }

                }
            }
        // }




        ?>

        <form action="register.php" method="post">

            <div class="mb-3">
                <input type="text" class="form-control" id="exampleFormControlInput1" name="fullname" placeholder="Full Name">

            </div>

            <div class="mb-3">
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="Password">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="exampleFormControlInput1" name="confirm_password" placeholder="Confirm Password">
            </div>


            <button class="btn btn-primary" type="submit" name="submit">Register</button>


        </form>



        <div class="mt-3">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>