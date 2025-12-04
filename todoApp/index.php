<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>



<body>

    <div class="todo-wrapper">
        <div class="todo-card">

            <h2 class="heading">My Tasks</h2>


            <?php

            include 'database.php';

            if (isset($_POST['add_task'])) {

                $task = $_POST['task_text'];

                $query = "insert into tasks (task,status) value ('$task','')";

                if (mysqli_query($conn, $query)) {
                    echo '<div class="alert alert-success" role="alert" id="msg">
                  Task Added Successfully.
                </div>';
                    echo '<script>
            setTimeout(function(){
                document.getElementById("msg").style.display = "none";
            }, 2000); 
          </script>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" id="msg">
                  Something went Wrong.
                </div>';
                    echo '<script>
            setTimeout(function(){
                document.getElementById("msg").style.display = "none";
            }, 2000);
          </script>';
                };
            }

            if (isset($_POST['complete'])) {
                $id = $_POST['complete'];
                mysqli_query($conn, "UPDATE tasks SET status='complete' WHERE id='$id'");
                header("Location: index.php");
                exit;
            }


            if (isset($_POST['delete'])) {

                $id = $_POST["delete"];

                $query = "delete from tasks where id = $id";


                if (mysqli_query($conn, $query)) {
                    echo '<div class="alert alert-danger" role="alert" id="msg">
                  Task Deleted Successfully.
                        </div>';
                    echo '<script>
                                    setTimeout(function(){
                                             document.getElementById("msg").style.display = "none";
                                             }, 2000); 
                                    </script>';
                                    header("Location: index.php");
                exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert" id="msg">
                  Something went wrong
                        </div>';
                    echo '<script>
                                    setTimeout(function(){
                                             document.getElementById("msg").style.display = "none";
                                             }, 2000); 
                                    </script>';
                }
            }

            ?>

            <form action="index.php" method="POST" class="add-form">
                <input
                    type="text"
                    name="task_text"
                    placeholder="Write your task..."
                    required>
                <button type="submit" name="add_task">Add</button>
            </form>


            <ul class="task-list">

                <?php

                $query = "select * from tasks";
                $res = mysqli_query($conn, $query);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        $status = strtolower(trim((string)$row['status']));

                        $completedClass = ($status === 'complete') ? 'completed' : '';

                        $taskText = htmlspecialchars($row['task'], ENT_QUOTES, 'UTF-8');

                        echo '
                            <li class="task-item ' . $completedClass . '" >
                                <span class="task-text">' . $taskText . '</span>

                                <div class="actions">
                                    <form action="index.php" method="POST">
                                        <input type="hidden" name="complete" value="' . $row['id'] . '" >
                                        <button class="complete-btn">Complete</button>
                                    </form>

                                    <form action="index.php" method="POST">
                                        <input type="hidden" name="delete" value="' . $row['id'] . '">
                                        <button class="delete-btn">Delete</button>
                                    </form>

                                </div>
                            </li>
                            ';
                    }
                }else{
                    echo '<li>No tasks available. Add a new task!</li>';
                }

                ?>
            </ul>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>