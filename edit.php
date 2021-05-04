<?php 

include_once "db.inc.php";

if (isset($_GET['edit_todo'])) {
    $e_id = $_GET['edit_todo'];
}

if(isset($_POST['edit_todo'])) {
    $edit_todo = $_POST['todo'];

    $query = "UPDATE tasklist SET t_name = '$edit_todo' WHERE t_id = $e_id";
    $run = mysqli_query($conn, $query);

    if(!$run) {
        die("failed");
    } else {
        header("location: index.php?updated");
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
            <h3>Edit to do</h3>
            <form action="" method="POST">

            <?php 
            
            $sql = "SELECT * FROM tasklist WHERE t_id = $e_id";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_array($result);
            
            ?>
                <div class="form-group">
                    <input type="text"  id="todo" name="todo" class="form-control" placeholder="To do name..." value="<?php echo $data['t_name']; ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" value="Add a new to do task list" type="submit" name="edit_todo">
                </div>
            </form>
        </div>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>

</html>