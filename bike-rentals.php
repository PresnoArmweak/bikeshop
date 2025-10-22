<?php
require __DIR__ . '/functions.php';
require __DIR__ . '/database.php';


$db = db();

if (!isset($db) || !($db instanceof PDO)) {
	throw new RuntimeException('Database failed');
}




// list of queries to run and display
$queries = [
	'sqlAvailableBikes' => sqlAvailableBikes(),
	'sqlAllBikesByPrice' => sqlAllBikesByPrice(),
	'sqlOpenRentals' => sqlOpenRentals(),
	'sqlJoinRentalsCustomers' => sqlJoinRentalsCustomers(),
	'sqlJoinRentalsBikes' => sqlJoinRentalsBikes(),
	'sqlTop3Bikes' => sqlTop3Bikes(),
	'sqlMultiJoinRentals' => sqlMultiJoinRentals(),
	'sqlUpdateCloseRental' => sqlUpdateCloseRental(),
	'sqlUpdateBikeUnavailable' => sqlUpdateBikeUnavailable(),
];

?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Bike Rentals – Queries</title>
		<style>
			body { font-family: system-ui, Arial, sans-serif; margin: 24px; }
			pre { background: #f6f8fa; padding: 12px; overflow: auto; }
			h2 { margin-top: 32px; }
			table { border-collapse: collapse; margin-top: 8px; }
			th { background: #eee; }
		</style>
	</head>
	<body>


	<?php
	// Execute UPDATE statements first
	$updateStmt = ['sqlUpdateCloseRental', 'sqlUpdateBikeUnavailable'];
	foreach ($updateStmt as $k) {
		$sql = $queries[$k];
		try {
			//do not display SQL or results
			$db->exec($sql);
		} catch (Throwable $e) {
			echo '<p style="color:#b00;">failed to update data' . htmlspecialchars($k) . ': ' . htmlspecialchars($e->getMessage()) . '</p>';
		}
		unset($queries[$k]); // makes sure that the update queries are not ran twice in the table building loop
	}

	// SELECT queries and render tables
	make_A_Table($queries, $db);
	?>

	</body>
</html>
