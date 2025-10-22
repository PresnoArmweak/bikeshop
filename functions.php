<?php


function sqlAvailableBikes(){
	return "SELECT bike_id, model, type, hourly_rate, available FROM bikes WHERE available = 1";
}

function sqlAllBikesByPrice(): string {
	return "SELECT bike_id, model, type, hourly_rate, available FROM bikes ORDER BY hourly_rate DESC, bike_id ASC";
}

function sqlAllCustomersByLastFirstName(): string {
    return "SELECT * FROM customers ORDER BY last_name, first_name;";
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

// sets up the table of that will be displayed for each query in the HTML to be called in a foreach loop
function renderTable(array $rows): string {
	if (empty($rows)) {
		return '<em>No rows returned.</em>';
	}
	$cols = array_keys($rows[0]);
    print_r($cols);
	$html = '<table border="1" cellpadding="6" cellspacing="0">';
	$html .= '<thead><tr>';
	foreach ($cols as $c) {
        $arrayPossition = (array_search($c, array_keys($cols)));

        if (fmod($arrayPossition, 2) === 0){
            $html .= '<th>' . htmlspecialchars((string)$c) . '</th>';//why
        }
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

//Create a display-friendly name by stripping a leading 'sql' prefix.

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

function make_A_Table($queries, $db){
    foreach ($queries as $name => $sql) {
            $id = displayName($name); // not needed here for what we are doing but for anything else you are doing on a page 
            $label = prettyName($name);
            echo '<h2 id="' . htmlspecialchars($id) . '">' . htmlspecialchars($label) . '</h2>'; // echo the title on the page
            try {
                $stmt = $db->query($sql); 
                print_r($stmt);
                $rows = $stmt ? $stmt->fetchALL() : [];
                print_r($rows);
                echo renderTable($rows);
            } catch (Throwable $e) {
                echo '<p style="color:#b00;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
        }
}  
?>