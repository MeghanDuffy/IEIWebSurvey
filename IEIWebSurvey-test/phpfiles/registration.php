<?php
session_start();
if(!($_SESSION['UID']==null)) {
    header("Location: http://www.zmbube.com/PreferenceSurvey.php");
}
$last =$first=$username=$password="";
$lasterr=$firsterr=$usererr=$passerr="";
$errors=false;
if($_SERVER["REQUEST_METHOD"]=="POST") {
    if (empty($_POST['last'])) {
        $lasterr="Last Name Required!";
        $errors=true;
    }
    else{
    $last = test_input($_POST['last']);
}
    if(empty($_POST['first'])){
        $firsterr="First Name Required!";
        $errors=true;
    }else {
        $first = test_input($_POST['first']);
    }
    if(empty($_POST['username'])){
        $usererr="User Name Required!";
        $errors=true;
    }else {
        $username = test_input($_POST['username']);
    }
    if(empty($_POST['pword'])){
        $passerr="Password Required!";
        $errors=true;
    }elseif(strlen($_POST['pword'])<8){
        $passerr="Password Must Be at least 8 characters!";
        $errors=true;
    }
    if(!$errors){
        $user='fall16';
        $password='Cs495IeI4';
        $database='IEIScheduler';

        $conn=mysqli_connect("localhost",$user,$password,$database);
        if(!$conn){
            echo "<span>ERROR SUBMITING REQUEST</span>";

        }else{
            $first= mysqli_escape_string($conn,$_POST['first']);
            $last= mysqli_escape_string($conn,$_POST['last']);
            $username= mysqli_escape_string($conn,$_POST['username']);
            $password= hash("sha256",mysqli_escape_string($conn,$_POST['pword']));
            $position= mysqli_escape_string($conn,$_POST['position']);
            $sql="Insert Into Teacher (F_Name,L_Name,U_ID,Password,Position) VALUES ('$first','$last','$username','$password','$position')";
            if(mysqli_query($conn,$sql)){
                $_SESSION['registered']="Succesfully Registered!";
                header("Location: http://www.zmbube.com/login.php");
            }else{
                if(strpos(mysqli_error($conn),'Duplicate entry') !== false){
                    echo "USERNAME ALREADY TAKEN";
                }
            }
        }
        mysqli_close($conn);
    }
}
/**
 * Created by PhpStorm.
 * User: Zachary
 * Date: 11/22/16
 * Time: 3:24 AM
 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>
Registration
</title>
<meta charset="UTF-8" />
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Last Name<input type="text" name="last" value=<?php $last?>> <?php echo $lasterr?><br>
    First Name<input type="text" name="first" value=<?php $first?>><?php echo $firsterr?><br>
    User Name<input type="text" name="username" value=<?php $username?>> <?php echo $usererr?><br>
    Password<input type="password" name="pword"> <?php echo $passerr?><br>
    (Must be at least 8 characters!)<br><br>
    Position:<input type="radio" name="position" value="T" checked>Teacher      <input type="radio" name="position" value="G">Graduate Student
    <br>
    <input type="submit" value="Submit">
</form>
</body>
