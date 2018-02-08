<?php
/**
* Created by PhpStorm.
* User: Zachary
* Date: 1/23/17
* Time: 4:58 PM
*/
session_start();
if($_SESSION['UID']==null){
    header("Location: https://www.zmbube.com/login.php");
}
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>
            IEI Preference Survey
        </title>
        <meta charset="UTF-8" />
    </head>
    <?php
    $result="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user='fall16';
    $password='Cs495IeI4';
    $database='IEIScheduler';
$conn=mysqli_connect("localhost",$user,$password,$database);
if(!$conn){
        $error= "<span>ERROR SUBMITING REQUEST</span>";
    }else{

    $user=$_SESSION['UID'];
    $query="Select * From Class_Pref Where U_ID='$user'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $query="Delete from Time_Pref Where U_ID='$user'";
        mysqli_query($conn,$query);
        $query= "Delete from Class_Pref Where U_ID='$user'";
        mysqli_query($conn,$query);
$query="Delete from Comments Where U_ID='$user'";
        mysqli_query($conn,$query);
    }

    $text = file_get_contents("IEIClasses.json");
    $json=json_decode($text,true);
    $classAr = $json["classes"];
    $times = $json["times"];

    $first= mysqli_escape_string($conn,$_POST['first']);
    $last= mysqli_escape_string($conn,$_POST['last']);
    $username= mysqli_escape_string($conn,$_SESSION['UID']);
    $c101=(int)$_POST['101'];$c102=(int)$_POST["102"];$c103=(int)$_POST["103"];$c104=(int)$_POST["104"];$c105=(int)$_POST["105"];$c106=(int)$_POST["106"];$c111=(int)$_POST["111"];$c112=(int)$_POST["112"];$c113=(int)$_POST["113"];$c114=(int)$_POST["114"];$c115=(int)$_POST["115"];$c116=(int)$_POST["116"];
    $c121=(int)$_POST["121"];$c122=(int)$_POST["122"];$c123=(int)$_POST["123"];$c124=(int)$_POST["124"];$c125=(int)$_POST["125"];$c126=(int)$_POST["126"];$c131=(int)$_POST["131"];$c132=(int)$_POST["132"];$c133=(int)$_POST["133"];$c134=(int)$_POST["134"];$c135=(int)$_POST["135"];$c136=(int)$_POST["136"];
    $c141=(int)$_POST["141"];$c142=(int)$_POST["142"];$c143=(int)$_POST["143"];$c144=(int)$_POST["144"];$c145=(int)$_POST["145"];$c146=(int)$_POST["146"];$c151=(int)$_POST["151"];$c152=(int)$_POST["152"];$c153=(int)$_POST["153"];$c154=(int)$_POST["154"];$c155=(int)$_POST["155"];$c156=(int)$_POST["156"];
    $c151G=(int)$_POST["151G"];$c152G=(int)$_POST["152G"];$c153G=(int)$_POST["153G"];$c154G=(int)$_POST["154G"];$c155G=(int)$_POST["155G"];$c156G=(int)$_POST["156G"];$c161=(int)$_POST["161"];$c162=(int)$_POST["162"];$c163=(int)$_POST["163"];$c164=(int)$_POST["164"];$c165=(int)$_POST["165"];$c166=(int)$_POST["166"];
    $c161G=(int)$_POST["161G"];$c162G=(int)$_POST["162G"];$c163G=(int)$_POST["163G"];$c164G=(int)$_POST["164G"];$c165G=(int)$_POST["165G"];$c166G=(int)$_POST["166G"];
    $sql="Insert Into Class_Pref(U_ID,`101`,`102`,`103`,`104`,`105`,`106`,`111`,`112`,`113`,`114`,`115`,`116`,`121`,`122`,`123`,`124`,`125`,`126`,`131`,`132`,`133`,`134`,`135`,`136`,`141`,`142`,`143`,`144`,`145`,`146`,`151`,`152`,`153`,`154`,`155`,`156`,`151G`,`152G`,`153G`,`154G`,`155G`,`156G`,`161`,`162`,`163`,`164`,`165`,`166`,`161G`,`162G`,`163G`,`164G`,`165G`,`166G`) VALUES ('$username','$c101','$c102','$c103','$c104','$c105','$c106','$c111','$c112','$c113','$c114','$c115','$c116','$c121','$c122','$c123','$c124','$c125','$c126','$c131','$c132','$c133','$c134','$c135','$c136','$c141','$c142','$c143','$c144','$c145','$c146','$c151','$c152','$c153','$c154','$c155','$c156','$c151G','$c152G','$c153G','$c154G','$c155G','$c156G','$c161','$c162','$c163','$c164','$c165','$c166','$c161G','$c162G','$c163G','$c164G','$c165G','$c166G')";
    if(mysqli_query($conn,$sql)){
        $result="Preferences Successfully Submitted";
    }else{
        $result="Failed to submit. Try again Later.";
    }
    $t8=((int)$_POST['8am']==0) ? 2 :(int)$_POST['8am'];
    $t9=((int)$_POST['9am']==0) ? 2 :(int)$_POST['9am'];
    $t10=((int)$_POST['10am']==0) ? 2 :(int)$_POST['10am'];
    $t11=((int)$_POST['11am']==0) ? 2 :(int)$_POST['11am'];
    $t12=((int)$_POST['12pm']==0) ? 2 :(int)$_POST['12pm'];
    $t1=((int)$_POST['1pm']==0) ? 2 :(int)$_POST['1pm'];
    $t2=((int)$_POST['2pm']==0) ? 2 :(int)$_POST['2pm'];
    $t3=((int)$_POST['3pm']==0) ? 2 :(int)$_POST['3pm'];
    $t4=((int)$_POST['4pm']==0) ? 2 :(int)$_POST['4pm'];
    $sql="Insert Into Time_Pref(U_ID,8am,9am,10am,11am,12pm,1pm,2pm,3pm,4pm) VALUES ('$username','$t8','$t9','$t10','$t11','$t12','$t1','$t2','$t3','$t4')";
    if(mysqli_query($conn,$sql)){
        $result="Preferences Successfully Submitted";
    }else{
        echo mysqli_error($conn);
        $result="Failed to submit. Try again Later.";
    }
    $comment=$_POST['comments'];
    $sql="Insert Into Comments(U_ID,Comment)VALUES ('$username','$comment')";
    if(mysqli_query($conn,$sql)){
        $result="Preferences Successfully Submitted";
    }else{
        echo mysqli_error($conn);
        $result="Failed to submit. Try again Later.";
    }
}
        mysqli_close($conn);
    }
    ?>
    <body>
    <p><?php echo $result;?></p>
    </body>

</html>