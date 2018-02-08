<?php
session_start();
//$user = "";
$error="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user='fall16';
    $password='Cs495IeI4';
    $database='IEIScheduler';
$conn=mysqli_connect("localhost",$user,$password,$database);
if(!$conn){
    $error= "<span>ERROR SUBMITING REQUEST</span>";
}else{
    $pword= hash("sha256",mysqli_escape_string($conn,$_POST['password']));
    $user=mysqli_escape_string($conn,$_POST['UID']);
    $sql="SELECT * FROM Teacher WHERE Teacher.U_ID='$user'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $checkPWord=$row['Password'];
        if($checkPWord==$pword){
            $_SESSION['UID']=$row["U_ID"];
        }
        else{
            $error="PASSWORD OR USERNAME INCORRECT!";
        }

    }
    mysqli_close($conn);
}

}

if ($_SESSION['UID'] != null) {
   header("Location: https://www.zmbube.com/PreferenceSurvey.php");
}
echo $_SESSION['registered'];
$_SESSION['registered']=null;
echo $error;


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Created by PhpStorm.
 * User: Zachary
 * Date: 11/22/16
 * Time: 3:24 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Login
    </title>
    <meta charset="UTF-8"/>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="UID">Username</label> <input type="text" id="UID" name="UID" value="<?php $user ?>"><br>
    <label for="password">Password</label> <input type="password" id="password" name="password"><br>
    <input type="submit" value="Submit">
    <a href="registration.php">Register</a>
</form>
</body>
