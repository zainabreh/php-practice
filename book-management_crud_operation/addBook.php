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

      <h1>Add New Book</h1>
      <a href="index.php"><button type="button" class="btn btn-primary mb-3">Back to All Books</button></a>

    </div>
    <form method="post" action="addBook.php">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Author</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="author">
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
          <input type="hidden" name="book_type" id="bookTypeInput"/>
        </div>
      </div>
      <div class="mb-3">
        <label for="floatingTextarea">Book Description</label>
        <textarea class="form-control" placeholder="enter book description here" id="floatingTextarea" name="description"></textarea>
      </div>
      <button type="submit" name="add" class="btn btn-primary">Add Book</button>
    </form>
  </div>


   <script>

    document.querySelectorAll('.dropdown-item').forEach(item=>{
      item.addEventListener('click',function(e){
        e.preventDefault();
        let itemValue = this.getAttribute('data-value');
        document.getElementById('bookTypeBtn').textContent  = itemValue;
        document.getElementById('bookTypeInput').value = itemValue;
      })
    })

  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>