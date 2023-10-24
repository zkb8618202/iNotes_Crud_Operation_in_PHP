<?php
require "dbconnect.php";

$success = false;
$error = false;
if($_SERVER['REQUEST_METHOD']=="POST"){
    $title = $_POST['title'];
    $desc = $_POST['desc'];

    if (empty($title AND $desc)) {
        $error = " Fill Your Notes";
    }else{
        $sql= "INSERT INTO `users` (`Title`, `Description`) VALUES ('$title', '$desc')";
        $result = mysqli_query($con,$sql);
        if($result){
            $success = true;
        }else{
            $error = " Site Have Some Issues...Sorry for Inconvenience";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>CRUD</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php require "nav.php";
      if($success){
      echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>Successfully Added Your Note!</strong>
      </div>';
      }
      if($error){
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            <span class='sr-only'>Close</span>
        </button>
        <strong>Error!</strong>. $error.
      </div>";
      }
      ?>
    <div class="container my-3">
        <h2>Welcome to iNotes</h2>
        <form action="index.php" method="post">
            <div class="form-group my-3">
                <label for="">Title</label>
                <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea class="form-control" name="desc"></textarea>
            </div>
            <button class="btn-primary btn-lg">Add Note</button>
        </form>
        </div>
        <div class="container my-5">
        <table class="table my-5" id="myTable">
            <thead class="thead-inverse">
                <tr>
                    <th>Sr</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php  
                    if(isset($_GET['delete'])){
                        $delid = $_GET['delete'];
                        $delsql = "DELETE FROM `users` WHERE srn='$delid'";
                        $results = mysqli_query($con,$delsql);
                        header("location: index.php");
                        exit;
                    }
                    $sql = "SELECT * FROM `users`";
                    $result = mysqli_query($con,$sql);
                    $sr=0;
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['srn'];
                        $sr++;
                        $titl = $row['Title'];
                        $descr = $row['Description'];
                        echo    '<tr>
                                    <td scope="row">'.$sr.'</td>
                                    <td>'.$titl.'</td>
                                    <td>'.$descr.'</td>
                                    <td><a href="" class="btn btn-primary mr-3 btn-sm">Edit</a><a href="?delete='.$id.'" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>';
                    }
            ?>
            </tbody>
        </table>
    </div>
    <hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>let table = new DataTable('#myTable');</script>
</body>

</html>