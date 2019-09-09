<?php

class Mailer {
    private $connection;

	public function __construct($db) {
		$this->connection = $db;
    }
    public function sendEmail($booking_row, $customer_row) {

            // $to      =   $customer_row->email;
            $subject    =   'La Casa Del Mar booking confirmation';
            $message    =   'Dear ' . $customer_row->name . "\r\n" .
                            'Thank you for your booking!' . "\r\n" .
                            'Your booking reference number is : ' . $booking_row->$customer_ID . "\r\n" .
                            'If you require any further assistance, please do not hesitate to contact us on +46 070123 44 88.' "\r\n" .
                            'Kind regards,' "\r\n" .
                            'La Casa Del Mar' "\r\n";
            $headers    =   'From: bookings@lacasadelmar.com' . "\r\n" .
                            'Reply-To: bookings@lacasadelmar.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
            $headers[]  =   'Content-type: text/html\r\n; charset=iso-8859-1';
        
            if(mail('sygiel@hotmail.com', $subject, $message, $headers)) {
                echo("Email sent");s
            }


            // $msg = "First line of text\nSecond line of text";

			// // use wordwrap() if lines are longer than 70 characters
			// $msg = wordwrap($msg,70);

			// // send email
			// mail("sygiel@hotmail.com","My subject",$msg);
    
    }
?>