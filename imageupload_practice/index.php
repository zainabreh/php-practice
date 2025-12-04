<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: start;
            padding-top: 40px;
        }

        .wrapper {
            width: 450px;
        }

        .add-btn {
            background: #00a8ff;
            border: none;
            padding: 10px 20px;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-bottom: 20px;
            transition: 0.2s ease;
        }

        .add-btn:hover {
            background: #0086cc;
        }

        .user-card {
            display: flex;
            align-items: center;
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transition: 0.2s ease;
        }

        .user-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .user-image {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            border: 3px solid #e6e6e6;
        }

        .user-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <a href="upload_image.php"><button class="add-btn">Add New</button></a>

        <?php

        include_once('database.php');

        $query = "select * from profileimage";
        $res = mysqli_query($conn, $query);
        $numrow = mysqli_num_rows($res);

        if ($numrow > 0) {
            while ($data = mysqli_fetch_assoc($res)) {
                $name = $data['name'];
                $image = 'uploads/'.$data['image'];
                echo " <div class='user-card'>
                            <div class='user-image'>
                                <img src='$image' alt=''>
                            </div>
                            <div class='user-name'>$name</div>
                        </div>";
            }
        }else{
            echo " <div class='user-card'>
                            
                            <div class='user-name'>No file found</div>
                        </div>";
        }

        ?>

    </div>

</body>

</html>