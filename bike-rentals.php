<?php
require __DIR__ . '/functions.php';
require __DIR__ . '/database.php';
if (!isset($pdo) || !($pdo instanceof PDO)) {
	throw new RuntimeException('Database failed');
}

$db = $pdo;

// sets up the table of that will be displayed for each query in the HTML to be called in a foreach loop
function renderTable(array $rows): string {
	if (empty($rows)) {
		return '<em>No rows returned.</em>';
	}
	$cols = array_keys($rows[0]);
	$html = '<table border="1" cellpadding="6" cellspacing="0">';
	$html .= '<thead><tr>';
	foreach ($cols as $c) {
		$html .= '<th>' . htmlspecialchars((string)$c) . '</th>';
	}
	$html .= '</tr></thead><tbody>';
	foreach ($rows as $r) {
		$html .= '<tr>';
		foreach ($cols as $c) {
			$val = $r[$c];
			$html .= '<td>' . htmlspecialchars((string)$val) . '</td>';
		}
		$html .= '</tr>';
	}
	$html .= '</tbody></table>';
	return $html;
}

/**
 * Create a display-friendly name by stripping a leading 'sql' prefix.
 */
function displayName(string $name): string {
	return preg_replace('/^sql/i', '', $name) ?? $name;
}


function prettyName(string $name): string {
	$n = displayName($name);
	// Insert space between lowercase->Uppercase boundaries
	$n = preg_replace('/([a-z])([A-Z])/', '$1 $2', $n);
	// Insert space between letter<->digit boundaries
	$n = preg_replace('/([A-Za-z])(\d)/', '$1 $2', $n);
	$n = preg_replace('/(\d)([A-Za-z])/', '$1 $2', $n);
	return trim($n ?? $name);
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
		unset($queries[$k]);
	}

	// SELECT queries and render tables
	foreach ($queries as $name => $sql) {
		$id = displayName($name); // not needed here for what we are doing but for anything else you are doing on a page 
		$label = prettyName($name);
		echo '<h2 id="' . htmlspecialchars($id) . '">' . htmlspecialchars($label) . '</h2>'; // echo the title on the page
		try {
			$stmt = $db->query($sql); 
			$rows = $stmt ? $stmt->fetchAll() : [];
			echo renderTable($rows);
		} catch (Throwable $e) {
			echo '<p style="color:#b00;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
		}
	}
	?>

	</body>
</html>
