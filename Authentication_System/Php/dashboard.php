<?php include_once('header.php'); 
ob_start();
session_start();
  if(!isset($_SESSION['user'])){
       header('location:'.BASE_URL);
       exit;
  }
?>
                <h2 class="mb_10">Dashboard</h2>
                <p>Hi Peter, Welcome to dashboard</p>
                
                <h2 class="mt_20">Your Profile Information</h2>
                <table class="t1">
                    <tr>
                        <td>First Name:</td>
                        <td><?php
                           echo $_SESSION['user']['firstname']
                        ?></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><?php echo $_SESSION['user']['lastname'] ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php
                               echo $_SESSION['user']['email']
                        ?></td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td><?php
                              echo  $_SESSION['user']['phone']
                        ?></td>
                    </tr>
                </table>
            </div>
        </div>
    <?php include_once('footer.php'); ?>
    
</body>
</html>