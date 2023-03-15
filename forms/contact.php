<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'herkusherkus.herkus@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();


  if(isset($_POST)){
    $formok = true;
  
    //form data
  
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
  
    //validation
    if(empty($name) || empty($email) || empty($message)){
      $formok = false;
    }
  
    if($formok){
      $headers = "From: info@nandccontractors.com" . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $emailbody = "<p>You have recieved a new message from the enquiries form on your website.</p>
                    <p><strong>Name: </strong> {$name} </p>
                    <p><strong>Email Address: </strong> {$email} </p>
                    <p><strong>Message: </strong> {$message} </p> ";
  
      mail("herkusherkus.herkus@gmail.com","New Enquiry",$emailbody,$headers);
  
    }
  
          //redirect back to form
          header('location: ' . $_SERVER['HTTP_REFERER']);
  
  }
  
?>
