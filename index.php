<?php
session_start();
$DB_servername = "localhost";
$DB_username = "root";
$DB_password = "";
$DB_Name = "testdb";
$connection = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_Name);
if (!$connection) {
    die("Failed" . mysqli_connect_error());
}
if (isset($_POST['submit'])) {

    $email = $_POST['email'];

    $_SESSION['email'] = $email;


    if (empty($_POST['email'])) {
        $emailError = "*Email field must be field";
    } else {
        $email = $_POST['email'];
    }
    $chk = mysqli_query($connection, "select * from quiz where email='$email' and status=1");
    $count = mysqli_num_rows($chk);
    $v= mysqli_fetch_assoc($chk);


    if ($count > 0) {
        $duplicate = "Email already exist and Already Examed  ";
    } else {
        // $_SESSION['email']=$v['email'];
        header('location:question.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">Online Quiz</a>

        </nav>
        <div class="container text-center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">Test</button><br><br>
        </div>
        <div class="">
            <span style="color:red"> <?php echo isset($emailError) ? $emailError : ""; ?></span><br>
            <span style="color:red"> <?php echo isset($duplicate) ? $duplicate : ""; ?></span><br>
        </div>



        <!-- Button trigger modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="container">
                        <h2>Entry Verification</h2>

                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" value="<?php echo isset($email) ? $email : ""; ?>" class="form-control" required id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Next Page</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>