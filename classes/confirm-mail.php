<?php

class Mailer {
    private $connection;

	public function __construct($db) {
		$this->connection = $db;
    }
    public function sendEmail($booking_row, $customer_row) {

            // $to      =   $customer_row->email;
            // $subject    =   'La Casa Del Mar booking confirmation';
            // $message    =   'hej';
            // $headers    =   'From: bookings@lacasadelmar.com' . "\r\n" .
            //                 'Reply-To: bookings@lacasadelmar.com' . "\r\n" .
            //                 'X-Mailer: PHP/' . phpversion();
            // $headers[]  =   'Content-type: text/html\r\n; charset=iso-8859-1';
        
            // if(mail('sygiel@hotmail.com', $subject, $message, $headers)) {
            //     echo("Email sent");
            // }
            // else {
            //     echo('not sent');
            // }


            $msg = "First line of text\nSecond line of text";

			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);

			// send email
            // mail("sygiel@hotmail.com","My subject",$msg);
            
            if(mail("sygiel@hotmail.com","My subject",$msg)) {
                echo("Email sent");
            }
            else {
                echo('not sent');
            }
    
    }
}
?>
