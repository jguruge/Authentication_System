<?php
  include_once('header.php');
  ob_start();
  session_start();
  include_once('config.php');
  if(isset($_REQUEST['form1'])){
    try{
       $password=addslashes($_REQUEST['password']);
       $confirm_password=addslashes($_REQUEST['confirmpassword']);
        if(trim($password)==''){
                throw new Exception("password can not be empty"); 
        }
        elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/",$password)){
                throw new Exception("Invalid Password! Password must be at least 8 characters, contain uppercase, lowercase, number, and special character");
        }
        elseif(trim($password)!=trim($confirm_password)){
                throw new Exception("Password does not match"); 
        }
        else{
            $success_message="Password Successfully changed You can login ";
             if(!isset($_SESSION['user_forgot_email'])){
                   throw new Exception('email is not found to update password');
             }
             else{
                $email=$_SESSION['user_forgot_email'];
                $Encrypt_password=password_hash($password,PASSWORD_DEFAULT);
                $statement=$pdo->prepare("update users SET  password=? WHERE email=?");
                $statement->execute([$Encrypt_password,$email]);
             }
        }
    }
       catch(Exception $e){
             $error_message = $e->getMessage();
       }
       
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px; text-align: center;">
        <h2 style="color: #333;">Forgot Password</h2>
          <?php
                if(isset($error_message)){
                    echo '<div class="error">';
                    echo $error_message;
                     echo '</div>';
                }
                if(isset($success_message)){
                    echo '<div class="success">';
                    echo $success_message;
                     echo '</div>';
                }

            ?>

        <form action="" method="post">
            <label for="email" style="display: block; margin-bottom: 10px; text-align: left; font-weight: bold;">Enter your password:</label>
            <input type="password" name="password" id="password" placeholder="password"
                   style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;" required>

            <label for="email" style="display: block; margin-bottom: 10px; text-align: left; font-weight: bold;">Confirm the password:</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder=" confirm password"
                   style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;" required>
       

            <input type="submit"name="form1"value="Confirm" style="width: 100%; background-color: #007bff; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">

            <p style="margin-top: 15px; font-size: 14px; color: #777;">
                Remembered your password? <a href="login.php" style="color: #007bff;">Login here</a>
            </p>
        </form>
    </div>

</body>
</html>
