 <?php

    if (isset($_POST['add'])) {
        include('database.php');
        $title = $_POST['title'];
        $author = $_POST['author'];
        $type = $_POST['book_type'];
        $description = $_POST['description'];

        $query = "insert into books (title,author,type,description) values (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $prepstmt = mysqli_stmt_prepare($stmt, $query);

        if ($prepstmt) {
            mysqli_stmt_bind_param($stmt, 'ssss', $title, $author, $type, $description);
            mysqli_stmt_execute($stmt);
            echo '<div class="alert alert-success" role="alert">
                  Book Added Successfully.
                </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                  Something went wrong.
                </div>';
        };
        mysqli_close($conn);
    }

    if (isset($_POST['edit'])) {
        include('database.php');
        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $type = $_POST['book_type'];
        $description = $_POST['description'];

        $query = "update books set title = ?, author = ?, type = ?, description = ? where id = ?";
        $stmt = mysqli_stmt_init($conn);
        $prepstmt = mysqli_stmt_prepare($stmt, $query);

        if ($prepstmt) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $title, $author, $type, $description, $id);
            mysqli_stmt_execute($stmt);
            echo '<div class="alert alert-success" role="alert">
                  Book Edited Successfully.
                </div>
                ';
            header("Location: editBook.php?id=$id&success=1");
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">
                  Something went wrong.
                </div>';
        };
        mysqli_close($conn);
    }





    ?>