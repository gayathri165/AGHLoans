<?php
    $email=$_POST['cst_email'];
    $subject = 'Your subject for email';
    $message = 'Body of your message';

    mail($email, $subject, $message);
?>