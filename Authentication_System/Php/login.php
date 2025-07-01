<?php
ob_start();
session_start();
include_once('config.php');   
   if(isset($_POST['form1'])){
       try{
             if(trim($_POST['email'])==''){
                throw new Exception("email can not be empty"); 
             }
             if(trim($_POST['logpassword'])==''){
                throw new Exception("Password can not be empty");
             }

             $statement=$pdo->prepare("SELECT * FROM users WHERE email=?");
             $statement->execute([$_POST['email']]);
             $total=$statement->rowCount();
             if($total){
                $result=$statement->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row){
                    $password=$row['password'];
                    if(!password_verify($_POST['logpassword'], $password)){
                        throw new Exception ('Passowrd does not match');
                    }
                }
             }
             $_SESSION['user']=$row;
             header('location:dashboard.php?');
        }
       catch(Exception $e){
        $error_message = $e->getMessage();
        if(isset($error_message)){
                    echo '<div class="error">';
                    echo $error_message;
                     echo '</div>';
                }
       }
   }
?>







<?php include_once('header.php'); ?>
                <h2 class="mb_10">Login</h2>
                <form action="" method="post">
                    <table class="t2">
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="logpassword" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Login" name="form1">
                                <a href="forgot-password.php" class="primary_color">Forget Password</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
  <?php include_once('footer.php'); ?>
    
</body>
</html>