<?php

include 'db.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=empanelment_report.csv');

$output = fopen("php://output", "w");

/* CSV HEADER */
fputcsv($output, [
    'Name',
    'Birthday',
    'PhilHealth No',
    'Type',
    'Empanelment Date'
]);

$search = $_GET['search'] ?? '';
$year = $_GET['year'] ?? '';

$sql = "SELECT * FROM empanelments WHERE 1=1";

if($search != ""){
    $sql .= " AND (client_name LIKE '%$search%' OR philhealth_no LIKE '%$search%')";
}

if($year != ""){
    $sql .= " AND YEAR(empanelment_date)='$year'";
}

$sql .= " ORDER BY id DESC";

$query = mysqli_query($conn, $sql);

/* DATA ROWS */
while($row = mysqli_fetch_assoc($query)){

    fputcsv($output, [
        $row['client_name'],
        $row['birthday'],
        $row['philhealth_no'],
        $row['type'],
        $row['empanelment_date']
    ]);

}

fclose($output);
exit();

?>