<?php

include('database.php');

if(isset($_POST['submit'])){

    $user_name = $_POST['fullname'];
    $image = $_FILES['image']['name'];
    $ext= pathinfo($image,PATHINFO_EXTENSION);
    $allowedTypes = array('gif','jpg','jpeg','png');
    $temp_image = $_FILES['image']['tmp_name'];
    $targetPath = "uploads/".$image;

    if(in_array($ext,$allowedTypes)){

        if(move_uploaded_file($temp_image,$targetPath)){

            $query = "insert into profileimage (name,image) values  (?,?)";
            // mysqli_query($query);
            $stmt = mysqli_stmt_init($conn);
            $stmtprepare = mysqli_stmt_prepare($stmt,$query);

            if($stmtprepare){

                mysqli_stmt_bind_param($stmt,'ss',$user_name,$image);
                mysqli_stmt_execute($stmt);
                echo"image uploaded successfully";
                header('Location: index.php');

            }else{
                echo"something is wrong";
            }

        }else{
            echo"failed to upload file";
        }
    }else{
        echo"files not allowed";
    }

}
?>