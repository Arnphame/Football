<?php session_start();
      include 'header.php';
      $user = new user();
      $matches = new match();
if(!empty($_SESSION['success']))
{?>
    <div class="alert success" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo $_SESSION['success'];
        $_SESSION['success'] = "";?>
    </div>
<?php } ?>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <h1>
            <?php
            if(!empty($_SESSION['user_login'])){
                echo "Welcome" . "<br>";
            }
            else{
            ?>
            </h1>
            <h1>You must log in to start using the system.</h1>
                <?php } ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">DATE</th>
                    <th scope="col">LOCATION</th>
                    <th scope="col">STATUS</th>
                </tr>
                </thead>
                <tbody>
                <?php
                echo "<pre>";
                $result = $matches->getAllMatches()->get_result();
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr><th scope='row'>" . $row['id'] . "</th><td>" . $row['date'] . "</td><td>" . $row['location'] . "</td><td>" . $row['status'] . "</td></tr>";
                } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>