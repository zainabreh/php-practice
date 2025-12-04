<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>

    <form method="post" action="send_email.php" enctype="multipart/form-data">

        <div class="container mt-5">
            <div class="text-center">
                <h2>Email Form with Image Upload</h2>
            </div>
            
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="fullname">
        </div>
        
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Subject</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="subject">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Message</label>
            <textarea class="form-control" id="exampleInputPassword1" name="message"></textarea>
        </div>

        <label for="formFile" class="form-label">Upload Image</label>
        <input type="file" class="form-control mb-3" name="attachment" id="formFile">

        <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>