<?php include 'header.php';
session_start();
if(empty($_SESSION['error']))
    $errMsg = "";
else
    $errMsg = $_SESSION['error'];
?>
<html>
<body style="background: url(../vendor/img/photo-1473976345543-9ffc928e648d.jpg) no-repeat center center fixed; background-size: cover;">
<link href="../vendor/custom_css/style.css" rel="stylesheet">
    <div class="vertical-center">
        <div class="container col-lg-3 centered" style="padding: 10px; background-color: rgba(0,0,0,0.8)">
        <h2 class="text-center" style="color: white">Registration</h2>
        <form method="post" action="../module/registration.php" name="reg">
            <div class="form-group" style="color: white">
                <label for="username">Login Name</label>
                <input class="form-control " id="login" name="login" type="text" placeholder="Enter user name here" required value="<?php if(!empty($_SESSION['saved name'])) echo $_SESSION['saved name']; ?>">
            </div>
            <div class="form-group" style="color: white">
                <label for="email">Email</label>
                <input class="form-control " id="email" name="email" type="text" placeholder="Enter email here" required">
            </div>
            <div class="form-group" style="color: white">
                <label for="pass">Password</label>
                <input id="pass" name="pass" type="password" class="form-control" placeholder="Enter password here" required>
            </div>
            <div class="form-group" style="color: white">
                <label for="pass">Enter Password Again</label>
                <input id="pass2" name="pass2" type="password" class="form-control" placeholder="Enter password again here" required>
            </div>
            <input class="btn btn-primary" name="submit" type="submit" value="Register">
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
</body>
</html>
<?php include 'footer.php'; ?>