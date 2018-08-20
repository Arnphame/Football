<?php include 'class/user.php';
$user = new user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Football</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/custom_css/style.css" rel="stylesheet">

</head>

<body>
<?php if(empty($_SESSION['user_login'])){ ?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg static-top navbar-custom navbar-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">Football</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php } ?>
<?php if(!empty($_SESSION['user_login'])){ ?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg static-top navbar-custom navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Football</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php } ?>
</body>
</html>