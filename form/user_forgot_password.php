<?php include 'header.php';
$user = new user();
session_start();
if(!empty($_SESSION['user_login'])) {
    $_SESSION['error'] = "You are logged in.";
    header("Location:index.php");
}
if(empty($_SESSION['error']))
    $errMsg = "";
else
    $errMsg = $_SESSION['error'];
?>
    <html>
    <link href="../vendor/custom_css/style.css" rel="stylesheet">
    <body style="background: url(../vendor/img/photo-1473976345543-9ffc928e648d.jpg) no-repeat center center fixed; background-size: cover;">
    <div class="vertical-center">
        <div class="container col-lg-3 centered" style="padding: 10px; background-color: rgba(0,0,0,0.8)">
            <h2 class="text-center" style="color: white">Forgot password</h2>
            <form method="post" action="../module/forgot_password.php" name="forgot">
                <div class="form-group" style="color: white">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="text" placeholder="Enter email here" required>
                </div>
                <input class="btn btn-primary" name="submit" type="submit" value="Send my password to email">
            </form>
            <?php if(!empty($errMsg))
            {?>
                <div class="alert" id="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <?php echo $errMsg;
                    $errMsg = ""; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    </body>
    </html>
<?php include 'footer.php'; ?>