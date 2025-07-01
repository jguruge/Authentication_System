<?php
require 'header.php';
require 'vendor/autoload.php';
ob_start();
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once('config.php'); 
   if(isset($_REQUEST['form1'])){
         $Email=addslashes($_REQUEST['email']);
         try{
              if(trim($Email)==''){
                    throw new Exception("Please Fill th email ");
               }
              if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
                    throw new Exception("Email is not validate");
              }
             $statement=$pdo->prepare("SELECT * FROM users WHERE email=? AND status=?");
             $statement->execute([$Email,1]);
             $total=$statement->rowCount();
             if(!$total){
                 throw new Exception("Email is not Found");
             }
             $_SESSION['user_forgot_email']= $Email;

             $success_message="Please check your email and follow steps";
             if(isset($success_message)){
                    echo '<div class="success">';
                    echo $success_message;
                     echo '</div>';
                }
             $token=time();
             $link = BASE_URL.'reset-password-verify.php?email='.$_POST['email'].'&token='.$token;
             $email_message = 'Please click on this link to reset you password: <br>';
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
                    $mail->Subject = 'Reset Password';
                    $mail->Body = $email_message;
                    $mail->send();
                   

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }

              
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
                <h2 class="mb_10">Forget Password</h2>
                <form action="" method="post">
                    <table class="t2">
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Submit" name="form1">
                                <a href="login.php" class="primary_color">Back to Login Page</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
 
     <?php include_once('footer.php'); ?>
</body>
</html>