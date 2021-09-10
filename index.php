<?php 

include_once "db.inc.php";

$query = "SELECT * FROM task_list";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $todo = $_POST['todo'];
   $date = date('Y-m-d');

   // $date = date('l dS F\, Y');
   
   if (empty($todo)) {
    $error = "Field is required. Add a new task!";
   }
   else {
    $sql = "INSERT INTO task_list (t_name, t_date) VALUES('$todo', '$date');";
    $results = mysqli_query($conn, $sql);

    if (!$results) {
        die("Failed");
    } else {
        header("Location:index.php?todo-added");
    }
}
}

if(isset($_GET['delete_todo'])) {
    $dtl_todo = $_GET['delete_todo'];
    $sqli = "DELETE FROM task_list WHERE t_id = $dtl_todo";
    $res = mysqli_query($conn, $sqli);
    if (!$res) {
        die("Failed");
    } else {
        header("Location:index.php?todo-deleted");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" />

    <title>To Do App with PHP & MySQL</title>
</head>

<body>
    <div class="container">
        <div class="todo">
            <h1>To Do App with PHP & MySQL</h1>
            <h3>Add a new to do</h3>
<?php 
 if (isset($error)) {
echo "<div class='alert alert-danger'>$error</div>";
 }

?>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <input type="text"  id="todo" name="todo" class="form-control" placeholder="To do name...">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" value="Add a new to do task list" type="submit">
                </div>
            </form>
        </div>

        <div class="col-lg-4">
            <form action="search.php" method="POST">
            <input class="form-control" type="text" name="search" placeholder="Search todo" />
            </form>
        </div>

        <div class="table-responsive col-lg-12">
            <table class="table table-bordered table-striped table-hover">
<thead>
    <th>ID</th>
    <th>To Do</th>
    <th>Date Added</th>
    <th>Edit To Do</th>
    <th>Delete To Do</th>
</thead>
<tbody>
<?php 
while ($row = mysqli_fetch_assoc($result)) {
 
     $t_id = $row['t_id'];
    $t_name = $row['t_name'];
    $t_date = $row['t_date'];
    ?>
<tr>
        <td><?php echo $t_id; ?></td>
        <td><?php echo $t_name; ?></td>
        <td><?php echo $t_date; ?></td>
        <td><a href="edit.php?edit_todo=<?php echo $t_id; ?>" class="btn btn-primary">Edit To Do</a></td>
        <td><a href="index.php?delete_todo=<?php echo $t_id;?>" class="btn btn-danger">Delete To Do</a></td>
      
    </tr>

<?php }

?>
    
</tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>

</html>