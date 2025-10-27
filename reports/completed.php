<?php
// Create a custom renderCompletedRentals function that adds duration and cost calculation
function renderCompletedRentals(array $rows): string {
    if (empty($rows)) {
        return '<em>No completed rentals found.</em>';
    }
    
    $html = '<table border="1" cellpadding="6" cellspacing="0">';
    $html .= '<thead><tr>';
    $html .= '<th>Bike Model</th>';
    $html .= '<th>Customer Name</th>';
    $html .= '<th>Start Time</th>';
    $html .= '<th>End Time</th>';
    $html .= '<th>Duration (minutes)</th>';
    $html .= '<th>Total Cost</th>';
    $html .= '</tr></thead><tbody>';
    
    foreach ($rows as $r) {
        $start = new DateTime($r['start_time']);
        $end = new DateTime($r['end_time']);
        $interval = $start->diff($end);
        
        // total minutes = days*24*60 + hours*60 + minutes + seconds/60
        $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i + ($interval->s / 60);
        
        $hourly = (float) $r['hourly_rate'];
        $totalCost = ($minutes / 60) * $hourly;
        
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($r['model']) . '</td>';
        $html .= '<td>' . htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($start->format('Y-m-d H:i:s')) . '</td>';
        $html .= '<td>' . htmlspecialchars($end->format('Y-m-d H:i:s')) . '</td>';
        $html .= '<td style="text-align:right">' . htmlspecialchars(number_format($minutes, 2)) . '</td>';
        $html .= '<td style="text-align:right">$' . htmlspecialchars(number_format($totalCost, 2)) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}

// Set up query array like other reports
$querie = [
    'sqlCompletedRentals' => sqlCompletedRentals(),
];

// Override the default renderTable for this report only
$renderTable = 'renderCompletedRentals';