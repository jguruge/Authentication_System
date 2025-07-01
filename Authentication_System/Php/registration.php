<?php 
include_once('header.php');
include_once('config.php');   

require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php
   if(isset($_POST['form1'])){
      try{
            if(trim($_POST['firstname'])==''){
                   throw new Exception("First name can not be empty"); 
            }
             if($_POST['lastname'] == '') {
                   throw new Exception("Last name can not be empty");
            }
            if($_POST['email'] == '') {
                   throw new Exception("Email can not be empty");
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                  throw new Exception("Email is invalid");
            }
            $statement=$pdo->prepare("SELECT * FROM users WHERE email=?");
            $statement->execute([$_POST['email']]);
            $total=$statement->rowCount();
            if($total>0){
                throw new Exception('Email already exists');
            }

             if($_POST['phone'] == '') {
                throw new Exception("Phone can not be empty");
             }
             else if(!preg_match("/^(078|076|074|077|034|071)\d{7}$/", $_REQUEST['phone'])){
                throw new Exception("Invalid Phone Number");
             }

            if($_POST['password'] == '' || $_POST['retype_password'] == '') {
                 throw new Exception("Password can not be empty");
             }
             elseif(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/",$_POST['password'])){
                  throw new Exception("Invalid Password");
             }

             if($_POST['password'] != $_POST['retype_password']) {
                   throw new Exception("Passwords must match");
             }
             $success_message='Registration is completed. An email is sent to your email address. Please check that and verify the registration.';
             $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
             $token=time();
             $statement = $pdo->prepare("INSERT INTO users (firstname,lastname,email,phone,password,token,status) VALUES (?,?,?,?,?,?,?)");
             $statement->execute([$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['phone'],$password,$token,0]);

             $link = BASE_URL.'registration-verify.php?email='.$_POST['email'].'&token='.$token;
             $email_message = 'Please click on this link to verify registration: <br>';
             $email_message .= '<a href="'.$link.'">';
             $email_message .= 'Click Here';
             $email_message .= '</a>';
             $mail = new PHPMailer(true);
             try {
                    $mail->isSMTP();
                    $mail->Host = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true]];
                    $mail->Username = 'a16fa6f1fc5db1';
                    $mail->Password = 'b7cf1599c5553f';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 2525;

                    $mail->setFrom('info@lankapropert.online', 'LankaPropert');
                    $mail->addAddress($_POST['email']);
                    $mail->isHTML(true);
                    $mail->Subject = 'Registration Verification Email';
                    $mail->Body = $email_message;
                    $mail->send();
                    $success_message = 'Registration is completed. An email is sent to your email address. Please check that and verify the registration.';

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
        
      }
      catch(Exception $e){
           $error_message = $e->getMessage();
           
      }
   }
?>



<form action="" method="post">
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

    <table class="t2">
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstname" autocomplete="off" value="<?php if(isset($_POST['firstname'])) {echo $_POST['firstname']; } ?>"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastname" autocomplete="off" value="<?php if(isset($_POST['lastname'])) {echo $_POST['lastname']; } ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" autocomplete="off" value="<?php if(isset($_POST['email'])) {echo $_POST['email']; } ?>"></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" autocomplete="off" value="<?php if(isset($_POST['phone'])) {echo $_POST['phone']; } ?>"></td>
        </tr>
        <tr>
           <td>Password</td>
            <td><div id="passwordHint" class="hint">Password must be at least 8 characters, contain uppercase, lowercase, number, and special character.</div>
             <input type="password" name="password" id="password" autocomplete="off">
              </div>
            </td>
        </tr>
        <tr>
            <td>Retype Password</td>
            <td><input type="password" name="retype_password" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Submit" name="form1"></td>
        </tr>
    </table>
</form>

<?php include_once('footer.php'); ?>