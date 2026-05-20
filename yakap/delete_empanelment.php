<?php

include 'db.php';

$id=$_GET['id'];

mysqli_query(
$conn,

"DELETE FROM
empanelments

WHERE id='$id'"

);

header(
"location:empanelment.php"
);

?>