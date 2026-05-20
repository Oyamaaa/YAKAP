<?php

include 'db.php';

$name=$_POST['client_name'];
$birthday=$_POST['birthday'];
$phil=$_POST['philhealth_no'];
$type=$_POST['type'];
$date=$_POST['empanelment_date'];

$year=date("Y",strtotime($date));

$check=mysqli_query(
$conn,
"SELECT * FROM empanelments
WHERE client_name='$name'
AND YEAR(empanelment_date)='$year'"
);

if(mysqli_num_rows($check)>0){

echo "
<script>
alert('⚠️ Already empanelled this client in $year');
window.location='empanelment.php';
</script>
";

exit();

}

mysqli_query($conn,
"INSERT INTO empanelments(
client_name,birthday,philhealth_no,type,empanelment_date
)
VALUES(
'$name','$birthday','$phil','$type','$date'
)"
);

echo "
<script>
alert('✅ Saved Successfully');
window.location='empanelment.php';
</script>
";

?>