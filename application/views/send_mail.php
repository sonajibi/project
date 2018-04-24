<?php

$to = 'contact@codiant.com';
$subject = $_POST['subject'];
$txt = $_POST['message'];
$number = $_POST['number'];
$name = $_POST['name'];

$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1, user-scalable=no'/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
        <title>Grofee</title>

        <style type='text/css'>
            table         {mso-table-lspace:0pt;mso-table-rspace:0pt;}
            td,th	  {border-collapse:collapse;}
            td a img	  {text-decoration:none;border:none;}
        </style>


    </head>

    <body>
        <table align='center' cellspacing='0' cellpadding='0' width='730' style='table-layout:fixed;margin:0 auto;
        border:1px solid #F37224;border-collapse:collapse;padding:50px;font-family:Tahoma, Geneva, sans-serif; 
        font-size:15px'>
            <tbody>
            <tr bgcolor='#F37224'>
                <td valign='middle' align='center' style='padding:15px 15px'>
                    <img vspace='0' hspace='0' border='0' align='center' width='170' src='http://74.124.202.121/~grofee/images/email_logo.png'/>                   
                </td>              
            </tr> 
            <tr>
                <td valign='top' style='border:1px solid #ddd; padding:15px'>
                    <p><strong>Name : </strong> " . $name . "</p>
                    <p><strong>Email : </strong> " . $to . "</p>
<p><strong>Phone number : </strong> " . $number . "</p>
<p><strong>Subject : </strong> " . $subject . "</p>
<p><strong>Message : </strong> " . $txt . "</p>
</td>
</tr>
<tr bgcolor='#F37224'><td style='padding:10px 15px;color:#fff' align='center'>© 2018. All rights reserved</td></tr>
</tbody>
</table>
</body>
</html>

";
//$body = include './email_template/contact.php';


$headers = "From:  contact@codiant.com" . "\r\n" .
        "CC:  contact@codiant.com";

if (mail($to, $subject, $message, $headers)) {
     $data = array('status' => true, 'msg' => 'New password sent successfully. Please check your inbox.');
     $this->session->set_userdata($data);
    echo json_encode(['status' => true]);
} else {
    
    echo json_encode(['status' => false]);
}
?>