<?php
session_start();
$email = $_SESSION['email'];
$conn = mysqli_connect("localhost", "root", "", "testdb") or die("connection failed");
    $score=0;
    $status = 1;
    $correctAns = array('3', '4', '1', '2', '3');
    $ans = array();
    $msg = "";
    echo "session ";
    if (isset($_POST['submit'])) {

        echo "post ";

        for ($i = 0; $i < 5; $i++) {
            $key  =  'question' . ($i + 1);
            $ans[$i] = $_POST[$key];

            echo $_POST[$key];

            if ($ans[$i] == $correctAns[$i]) {
                $score++;
            }
        }



        if ($score < 1) {
            $msg = '<p class="text-danger">You have failed, study more <i class="fa-solid fa-face-angry text-danger"></i></p>';
        } elseif ($score > 1) {
            $msg = 'Wow! You havent failed <i class="fa-sharp fa-regular fa-thumbs-up"></i>';
        } elseif ($score > 3) {
            $msg = 'Good result! but it could be better! <i class="fa-light fa-face-laugh-beam"></i>';
        } else {
            $msg = 'OMG! You are a genious <i class="fa-solid fa-face-explode"></i>';
        }


        $sql = "insert INTO `quiz`(`email`,`score`, `status`) VALUES ('$email',$score,$status)";

        if (mysqli_query($conn, $sql)) {
            echo "added";
        } else {
            echo "not added";
        }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check answer</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container text-color-success">
        <div class="row">
            <nav class="navbar navbar-expand ">
                <div class="row"></div>
                <h1 class="col-4 text-start">Quiz App <i class="fa fa-question" aria-hidden="true"></i></h1>
                <ul class="navbar-nav col-8 justify-content-end">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="form.php">Add New</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cotact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                </ul>
            </nav>
        </div>
        </header>
        <main>
            <div class="row">
                <h5 class="col-4"> <?php echo isset($email) ? "hello " . $email : ""  ?> </h5>
                <div class="col-8"></div>
            </div>
            <div class="text-success">
                <h1 class="text-center">
                    <?php echo isset($msg) ? $msg : ""; ?>
                </h1>
                <h1 class="text-center">
                    <?php
                    if (isset($score)) {
                        if ($score > 1) {
                            echo '<p class="text-success"> your test score = ' . $score . '</p>';
                        } else {
                            echo '<p class="text-danger"> your test score = ' . $score . '</p>';
                        }
                    }
                    ?>
                </h1>
            </div>
            <div class="justify-content-center">
                <form action=""></form>

            </div>
        </main>

    </div>
    <header>
</body>

</html>