<?php

// Include database connection
include 'connect.php';

// Fetch all queries from the database
$query = "SELECT * FROM querycus";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Prepare the table rows
$rows = '';
while ($row = mysqli_fetch_assoc($result)) {
    $rows .= '<tr>';
    $rows .= '<td>' . htmlspecialchars($row['srNum']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['firstName']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['lastName']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['email']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['phoneNum']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['country']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['query']) . '</td>';
    $rows .= '<td>' . htmlspecialchars($row['ans']) . '</td>';
    $rows .= '</tr>';
}

// Return the table rows
echo $rows;

// Close the connection
mysqli_close($conn);
?>
