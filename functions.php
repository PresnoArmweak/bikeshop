<?php


function sqlAvailableBikes(){
	return "SELECT bike_id, model, type, hourly_rate, available FROM bikes WHERE available = 1";
}

function sqlAllBikesByPrice(): string {
	return "SELECT bike_id, model, type, hourly_rate, available FROM bikes ORDER BY hourly_rate DESC, bike_id ASC";
}


function sqlOpenRentals(): string {
	return "SELECT rental_id, bike_id, customer_id, start_time, total_cost FROM rentals WHERE end_time IS NULL ORDER BY rental_id";
}


function sqlJoinRentalsCustomers(): string {
	return "SELECT * FROM rentals r "
         . "JOIN customers c ON r.customer_id = c.customer_id ";
}

function sqlJoinRentalsBikes(): string {
	return "SELECT * "
		 . "FROM rentals r "
		 . "JOIN bikes b ON r.bike_id = b.bike_id ";
}


function sqlTop3Bikes(): string {
	return "SELECT bike_id, model, type, hourly_rate, available FROM bikes ORDER BY hourly_rate DESC, bike_id ASC LIMIT 3";
}


function sqlMultiJoinRentals(): string {
	return "SELECT * "
		 . "FROM rentals r "
		 . "JOIN customers c ON r.customer_id = c.customer_id "
		 . "JOIN bikes b ON r.bike_id = b.bike_id "
		 . "ORDER BY r.rental_id";
}


function sqlUpdateCloseRental(): string {
	return "UPDATE rentals SET end_time = NOW() WHERE rental_id = 3";
}

function sqlUpdateBikeUnavailable(): string {
	return "UPDATE bikes SET available = 0 WHERE bike_id = 4";
}

    
?>