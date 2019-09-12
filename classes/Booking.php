<?php

class Booking {
	private $connection;

	public function __construct($db) {
		$this->connection = $db;
	}

	public function deleteBooking($booking_ID, $booking_row, $customer_row) {
		$statement = $this->connection->prepare(
			'DELETE
			FROM bookings 
			WHERE booking_ID = ?'
		);

		$booking_ID=htmlspecialchars(strip_tags($booking_ID));
		$statement->bindParam(1, $booking_ID);
		
		if($statement->execute()) {
			// Booking deleted mail
			$to			=   $customer_row->email;
			$subject    =   'La Casa Del Mar booking cancellation';
			$from		=	'bookings@lacasadelmar.com';
			
			$headers 	 =	'MIME-Version: 1.0' . "\r\n";
			$headers	.=	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			$headers	.=	'From: '.$from."\r\n".
							'Reply-To: '.$from."\r\n" .
							'X-Mailer: PHP/' . phpversion();

			$message	 =	'<html><body>';
			$message	.=	'<h1>Hi ' . $customer_ID->name . '!</h1>';
			$message	.=	'<p>As requested, your recent booking with us has been cancelled!</p>';
			$message	.=	'<p>Please see details below:</p>';
			$message	.=	'<p>' . $customer_row->name . '</p>';
			$message	.=	'<p>' . $booking_row->guests . '</p>';
			$message	.=	'<p>' . $booking_row->sitting . '</p>';
			$message	.=	'<p>If you are receiving this cancellation email by mistake, please do not hesitate to contact us on +46 070123 44 88.</p>';
			$message	.=	'<p>We hope to see you soon!/p>';
			$message	.=	'<p>Kind regards,</p>';
			$message	.=	'<p>La Casa Del Mar</p>';
			$message	.=	'</body></html>';

			$message	=	wordwrap($message,70);
			
			if(mail($to, $subject, $message, $headers)) {
				echo 'Your mail has been sent successfully.';
			} else{
				echo 'Unable to send email. Please try again.';
			}

			return true;
		}

		return false;
	}

	public function updateBooking($booking_row, $customer_row) {
		$statement = $this->connection->prepare(
			"UPDATE bookings 
			SET customer_ID = :customer_ID, 
			guests = :guests, 
			sitting = :sitting
			WHERE booking_ID = :booking_ID"
		);

		if($statement->execute(
			[
				":booking_ID" => $booking_row->booking_ID,
				":customer_ID" => $booking_row->customer_ID,
				":guests" => $booking_row->guests,
				":sitting" => $booking_row->sitting				
			]
			)) {
				// Booking update confirmation mail
				$to			=   $customer_row->email;
				$subject    =   'La Casa Del Mar booking update';
				$from		=	'bookings@lacasadelmar.com';
				
				$headers 	 =	'MIME-Version: 1.0' . "\r\n";
				$headers	.=	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
				$headers	.=	'From: '.$from."\r\n".
								'Reply-To: '.$from."\r\n" .
								'X-Mailer: PHP/' . phpversion();

				$message	 =	'<html><body>';
				$message	.=	'<h1>Hi ' . $customer_ID->name . '!</h1>';
				$message	.=	'<p>Your recent booking with us has been updated!</p>';
				$message	.=	'<p>Please see details below:</p>';
				$message	.=	'<p>' . $customer_row->name . '</p>';
				$message	.=	'<p>' . $booking_row->guests . '</p>';
				$message	.=	'<p>' . $booking_row->sitting . '</p>';
				$message	.=	'<p>If you require any assistance, please do not hesitate to contact us on +46 070123 44 88.</p>';
				$message	.=	'<p>To cancel your booking, please click the link below</p>';
				$message	.=	'<p><a href="http://localhost/admin/delete-booking.php/?booking_ID=$booking_ID">Cancel booking 1</a></p>';
				$message	.=	'<p><a href="http://localhost/admin/delete-booking.php/?booking_ID=$booking_row->booking_ID">Cancel booking 2</a></p>';
				$message	.=	'<p>Kind regards,</p>';
				$message	.=	'<p>La Casa Del Mar</p>';
				$message	.=	'</body></html>';

				$message	=	wordwrap($message,70);
				
				if(mail($to, $subject, $message, $headers)) {
					echo 'Your mail has been sent successfully.';
				} else{
					echo 'Unable to send email. Please try again.';
				}

				return true;
			}
	
		return false;
	}

	public function getBookedTables($date) {
		$statement = $this->connection->prepare(
			'SELECT * FROM bookings 
			WHERE DATE(sitting) = :date'
		);
			
		$statement->execute([
			':date' => $date
		]);
		$all_bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $all_bookings;
	}

	public function getBookings() {
		// select all and prepare query statement
		$statement = $this->connection->prepare(
			'SELECT * FROM bookings
			LEFT JOIN customers
			ON bookings.customer_ID = customers.customer_ID'
		);

		// execute query
		$statement->execute();
		
		$all_bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $all_bookings;
	}

	public function createBooking($booking_row, $customer_row, $booking_ID) {
		$statement = $this->connection->prepare(
			'INSERT INTO bookings (customer_ID, guests, sitting) 
			VALUES (:customer_ID, :guests, :sitting)'
		); 

		// sanitize
		$booking_row->$customer_ID = htmlspecialchars(strip_tags($booking_row->$customer_ID));
		$booking_row->$guests = htmlspecialchars(strip_tags($booking_row->$guests));
		$booking_row->$sitting = htmlspecialchars(strip_tags($booking_row->$sitting));

		$statement->bindParam(':customer_ID', $booking_row->customer_ID);
		$statement->bindParam(':guests', $booking_row->guests);
		$statement->bindParam(':sitting', $booking_row->sitting); 

		if ($statement->execute()) {
			// Booking confirmation mail
			$to			=   $customer_row->email;
			$subject    =   'La Casa Del Mar booking confirmation';
			$from		=	'bookings@lacasadelmar.com';
			
			$headers 	 =	'MIME-Version: 1.0' . "\r\n";
			$headers	.=	'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
			$headers	.=	'From: '.$from."\r\n".
							'Reply-To: '.$from."\r\n" .
							'X-Mailer: PHP/' . phpversion();

			$message	 =	'<html><body>';
			$message	.=	'<h1>Hi ' . $customer_ID->name . '!</h1>';
			$message	.=	'<p>Thank you for your booking! Booking reference number: ' . $booking_row->booking_ID . '</p>';
			$message	.=	'<p>If you require any assistance, please do not hesitate to contact us on +46 070123 44 88.</p>';
			$message	.=	'<p>To cancel your booking, please click the link below</p>';
			$message	.=	'<p><a href="http://localhost/admin/delete-booking.php/?booking_ID=$booking_ID">Cancel booking 1</a></p>';
			$message	.=	'<p><a href="http://localhost/admin/delete-booking.php/?booking_ID=$booking_row->booking_ID">Cancel booking 2</a></p>';
			$message	.=	'<p>Kind regards,</p>';
			$message	.=	'<p>La Casa Del Mar</p>';
			$message	.=	'</body></html>';

			$message	=	wordwrap($message,70);
			
			if(mail($to, $subject, $message, $headers)) {
				echo 'Your mail has been sent successfully.';
			} else{
				echo 'Unable to send email. Please try again.';
			}

			return true;
		}

		return false;
	}
}

class BookingRow {
	public $booking_ID;
	public $customer_ID;
	public $guests;
	public $sitting;
}
