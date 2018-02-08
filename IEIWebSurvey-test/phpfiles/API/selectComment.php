<?php
$user='fall16';
$password='Cs495IeI4';
$database='IEIScheduler';
$conn=mysqli_connect("localhost",$user,$password,$database);
if(!$conn)
    $error = "<span>ERROR SUBMITTING REQUEST</span>";
$sql = "select * from Comments";
$result = mysqli_query($conn, $sql);

$preferenceArray = array();
while($row = mysqli_fetch_assoc($result)){
    $preferenceArray[] = $row;
}
echo json_encode($preferenceArray);
?>