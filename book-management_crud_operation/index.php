<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center p-3 mb-3 bg-light">
    
    <h1>All Books</h1>
    <a href="addBook.php"><button type="button" class="btn btn-primary mb-3">Add New Book</button></a>
    </div>
    
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Type</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

    <?php
      include('database.php');

      $insertQuery = "select * from books";

      $stmt = mysqli_stmt_init($conn);
      $stmtprepare = mysqli_stmt_prepare($stmt,$insertQuery);

      if($stmtprepare){
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);

        $rows = mysqli_num_rows($res);

        if($rows > 0 ){
          while($book = mysqli_fetch_assoc($res)){
            echo '<tr>
            <th scope="row">'.$book['id'].'</th>
            <td>'.$book['title'].'</td>
            <td>'.$book['author'].'</td>
            <td>'.$book['type'].'</td>
              <td>
              <a href="detailPage.php?id='.$book["id"].'"><button type="button" class="btn btn-info">Read More</button></a>
            

              <a href="editBook.php?id='.$book["id"].'"><button type="button" class="btn btn-warning">Edit</button></a>

              
              <a href="deleteBook.php?id='.$book["id"].'"><button type="button" class="btn btn-danger" name="delete">Delete</button></a>
          </td>
            </tr>';
          };
        };
      };
      mysqli_close($conn);
      ?>
   
  </tbody>
</table>
</div>    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>