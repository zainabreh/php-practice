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

        if (isset($_POST['login'])) {

            require_once 'database.php';


            $email = $_POST['email'];
            $pass = $_POST['password'];

            $query = "select * from users where email = ?";

            $stmt = mysqli_stmt_init($conn);

            $stmtprepare = mysqli_stmt_prepare($stmt, $query);

            if ($stmtprepare) {
                mysqli_stmt_bind_param($stmt, 's', $email);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);

                $rowsCount = mysqli_num_rows($res);

                if ($rowsCount > 0) {
                    $user = mysqli_fetch_assoc($res);

                    if (password_verify($pass, $user['password'])) {
                        echo '<div class="alert alert-success" role="alert">
                            Login Successfully.
                        </div>';
                        session_start();

                        $_SESSION['id'] = $user['id'];
                        $_SESSION['fullName'] = $user['fullName'];
                        $_SESSION['email'] = $user['email'];

                        header('Location: index.php');
                        exit();

                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                        Password is wrong.
                    </div>';
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                        Email donot exist.
                    </div>';
                }
            }
            
        }

        ?>

        <form action="login.php" method="post">
            <div class="mb-3">
                <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="exampleFormControlInput1" name="password" placeholder="Password">
            </div>


            <button class="btn btn-primary" type="submit" name="login">LogIn</button>
        </form>

        <div class="mt-3">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>