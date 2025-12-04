<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <div class="card shadow-sm">
        <div class="row g-0">
            <!-- Uncomment and use book cover if available
            <div class="col-md-4">
                <img src="book-cover.jpg" class="img-fluid rounded-start" alt="Book Cover">
            </div>
            -->
            <div class="col-md-12">
                <?php
                include('database.php');

                if(!isset($_GET['id'])){
                    echo '<div class="card-body"><p class="text-danger">Book ID not provided.</p></div>';
                    exit;
                }

                $id = $_GET['id'];

                $getQuery = "SELECT * FROM books WHERE id = ?";
                $stmt = mysqli_stmt_init($conn);

                if(mysqli_stmt_prepare($stmt, $getQuery)){
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);

                    if($book = mysqli_fetch_assoc($res)){
                        ?>
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <h5 class="text-muted">Author: <?php echo htmlspecialchars($book['author']); ?></h5>
                            <p class="card-text mt-3">
                                <strong>Genre:</strong> <?php echo htmlspecialchars($book['type']); ?><br>
                            </p>
                            <p class="card-text">
                                <strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?>
                            </p>
                            <div class="mt-4">
                                <a href="index.php" class="btn btn-secondary">Back to List</a>
                                <a href="editBook.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="deleteBook.php?id=<?php echo $book['id']; ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo '<div class="card-body"><p class="text-danger">Book not found.</p></div>';
                    }
                } else {
                    echo '<div class="card-body"><p class="text-danger">Failed to prepare statement.</p></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
