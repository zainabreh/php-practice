<?php
  include('process.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add-Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light">
      <h1>Edit Book</h1>
      <a href="index.php"><button type="button" class="btn btn-primary mb-3">Back to All Books</button></a>
    </div>
     <?php
    include('database.php');

    $id = $_GET['id'] ?? null;

    $getQuery = "select * from books where id = ?";
    $stmt = mysqli_stmt_init($conn);
    $stmtprepare = mysqli_stmt_prepare($stmt,$getQuery);

    if($stmtprepare){
      mysqli_stmt_bind_param($stmt,'i',$id);
      mysqli_stmt_execute($stmt);

      $res = mysqli_stmt_get_result($stmt);

      $rows = mysqli_num_rows($res);

      if($rows > 0){
        $book = mysqli_fetch_assoc($res);
        ?>

        <form method="post" action="editBook.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="<?php echo $book['title']; ?>" aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Author</label>
        <input type="text"  name="author" class="form-control" value="<?php echo $book['author']; ?>" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <div class="btn-group">
          <button class="btn btn-secondary dropdown-toggle" id="bookTypeBtn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
            Book Type
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-value="Fiction">Fiction</a></li>
            <li><a class="dropdown-item" href="#" data-value="Fantasy">Fantasy</a></li>
            <li><a class="dropdown-item" href="#" data-value="Science-Fiction">Science Fiction</a></li>
            <li><a class="dropdown-item" href="#" data-value="Mystery">Mystery / Thriller</a></li>
            <li><a class="dropdown-item" href="#" data-value="Romance">Romance</a></li>
            <li><a class="dropdown-item" href="#" data-value="Historical-Fiction">Historical Fiction</a></li>
            <li><a class="dropdown-item" href="#" data-value="Non-Fiction">Non-Fiction</a></li>
            <li><a class="dropdown-item" href="#" data-value="Classics">Classics</a></li>
            <li><a class="dropdown-item" href="#" data-value="Adventure">Adventure</a></li>
          </ul>
          <input type="hidden" value="<?php echo htmlspecialchars($book['type']); ?>" name="book_type" id="bookTypeInput" />
        </div>
      </div>
      <div class="mb-3">
        <label for="floatingTextarea">Book Description</label>
        <textarea class="form-control" placeholder="enter book description here" name="description" id="floatingTextarea"><?php echo $book['description']; ?></textarea>
      </div>
      <input type="hidden" name="id" value="<?php echo $book['id']; ?>"/>
      <button type="submit" name="edit" class="btn btn-primary">Edit Book</button>
    </form>

        <?php
      }

    }
   

    ?>
    
  </div>

  <script>
    document.getElementById('bookTypeBtn').textContent = document.getElementById('bookTypeInput').value;

    document.querySelectorAll('.dropdown-item').forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        let itemValue = this.getAttribute('data-value');
        document.getElementById('bookTypeBtn').textContent = itemValue;
        document.getElementById('bookTypeInput').value = itemValue;
      })
    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>