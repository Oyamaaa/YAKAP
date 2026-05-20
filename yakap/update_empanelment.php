<?php

session_start();

include 'db.php';

/* GET FORM DATA */

$id = $_POST['id'];

$client_name = mysqli_real_escape_string(
$conn,
$_POST['client_name']
);

$birthday = mysqli_real_escape_string(
$conn,
$_POST['birthday']
);

$philhealth_no = mysqli_real_escape_string(
$conn,
$_POST['philhealth_no']
);

$type = mysqli_real_escape_string(
$conn,
$_POST['type']
);

$empanelment_date = mysqli_real_escape_string(
$conn,
$_POST['empanelment_date']
);

/* UPDATE RECORD */

mysqli_query(

$conn,

"UPDATE empanelments SET

client_name='$client_name',

birthday='$birthday',

philhealth_no='$philhealth_no',

type='$type',

empanelment_date='$empanelment_date'

WHERE id='$id'"

);

/* REDIRECT */

header(
"Location: empanelment.php"
);

exit();

?>