<?php
include 'connect.php';

// Fetch only non-answered queries from the database
$query = "SELECT * FROM querycus WHERE ans='Not Answered'";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

// Generate HTML table rows for the non-answered queries
$output = '';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= "<tr>";
    $output .= "<td>" . htmlspecialchars($row['srNum']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['firstName']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['lastName']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['email']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['phoneNum']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['country']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['query']) . "</td>";
    $output .= "<td>" . htmlspecialchars($row['ans']) . "</td>";
    $output .= "<td><button onclick=\"showAnswerForm(" . $row['srNum'] . ")\">Add Answer</button></td>";
    $output .= "</tr>";
}

echo $output;
?>
