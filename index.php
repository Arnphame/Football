<?php session_start();
      include 'header.php';
      $user = new user();
if(!empty($_SESSION['success']))
{?>
    <div class="alert success" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo $_SESSION['success'];
        $_SESSION['success'] = "";?>
    </div>
<?php }
if(!empty($_SESSION['error']))
{?>
    <div class="alert" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo $_SESSION['error'];
        $_SESSION['error'] = ""; ?>
    </div>
<?php } ?>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <h1>
            <?php
            if(!empty($_SESSION['user_login'])){
                echo "Prisijungiau";
                echo $_SESSION['user_id'];
            }
            else{
            ?>
            </h1>
            <h1>You must log in to start using the system.</h1>
                <?php } ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>