<?php
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
<body>
<button onclick="showFundamental()">Fundamental</button>
<button onclick="showLevel1()">Level 1</button>
<button onclick="showLevel2()">Level 2</button>
<button onclick="showLevel3()">Level 3</button>
<button onclick="showLevel4()">Level 4</button>
<button onclick="showLevel5U()">Level 5 Undergrad</button>
<button onclick="showLevel5G()">Level 5 Graduate</button>
<button onclick="showLevel6U()">Level 6 Undergrad</button>
<button onclick="showLevel6G()">Level 6 Graduate</button>
<form method="post" action="Submission.php">
<?php
$inDatabase=false;
$classrow=null;
$user='fall16';
$password='Cs495IeI4';
$database='IEIScheduler';
$conn=mysqli_connect("localhost",$user,$password,$database);
if(!$conn){
    $error= "<span>ERROR SUBMITTING REQUEST</span>";
}else{
    $user=$_SESSION['UID'];
    $query="Select * From Class_Pref Where U_ID='$user'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $classrow=mysqli_fetch_assoc($result);
        $inDatabase=true;
    }
}

/**
 * Created by PhpStorm.
 * User: Zachary
 * Date: 11/17/16
 * Time: 4:30 PM
 */
    $value=1;
    $maxValue=4;
    function getValue($name){
        if($GLOBALS['value']>$GLOBALS['maxValue']){
            $GLOBALS['value']=1;
        }
        $value=$GLOBALS['value'];
        $GLOBALS['value']=$GLOBALS['value']+1;
        return "\"$value\"".isChecked($name,$value);
    }
    function getButtonText($name){
        return "<input type=\"radio\" name=\"$name\" value=".getValue($name);
    }
    function isChecked($name,$value){
    if($GLOBALS['classrow'][$name]==$value or ($value==1 and !$GLOBALS['inDatabase']) and $GLOBALS['maxValue']!=1){
        if($GLOBALS['maxValue']==1){
            return " class='re' checked='true'";
        }
        return " checked";
    }
    elseif($GLOBALS['maxValue']==1){
        return " class='re'";
    }
    else{
        return "";
    }
    }

    $preferred="Most Preferred<br>";
    $secondaryPreferred="Secondary Preferred<br>";
    $neutral= "Neutral<br>";
    $notPreferred="Not Preferred<br>";
    $text = file_get_contents("IEIClasses.json");
    $json=json_decode($text,true);
    $classAr = $json["classes"];
    $times = $json["times"];
for($i=0;$i<9;$i++) {
    $classTableName = "classLevel" . $i;
    echo "<table border='1' id='$classTableName' hidden>";
    echo "<tr><td>Class</td><td>$preferred</td><td>$secondaryPreferred</td><td>$neutral</td><td>$notPreferred</td></tr>\n";
    for ($j = 0; $j < 6; $j++) {
        $class = $classAr[($i * 6) + $j];
        echo "<tr><td>$class</td> <td>" . getButtonText($class) . " ></td><td>" . getButtonText($class) . "> </td><td>" . getButtonText($class) . "> </td><td>" . getButtonText($class) . "> </td></tr>\n";
    }
    echo "</table>";
}
echo "<br><br>";
    $GLOBALS['maxValue']=1;
    //retrieve old time preferences
if($inDatabase){
    $query="Select * From Time_Pref Where U_ID='$user'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        $classrow=mysqli_fetch_assoc($result);
    }
}


    echo "<table border='1'><tr><td>Time</td><td>Preferred</td></tr>\n";
    foreach($times as $time){
        echo "<tr><td>$time</td><td>".getButtonText($time)." ></td>\n";
    }
    echo"</table>\n";
?>
    <br>
    <?php
    if($inDatabase){
        $query="Select * From Comments Where U_ID='$user'";
        $result=mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            $classrow=mysqli_fetch_assoc($result);
        }
    }
    ?>
    Comments/Special Requests/Other Classes:<br><textarea rows="5" cols="50" name="comments"><?php echo $classrow['Comment']?></textarea><br>
    <input type="submit" value="Submit">
</form>

<script type="text/javascript">
    var allRadios = document.getElementsByClassName('re');
    var booRadio;
    var x = 0;
    for(x = 0; x < allRadios.length; x++){

        allRadios[x].onclick = function() {

            if(booRadio == this){
                this.checked = false;
                booRadio = null;
            }
            else{
                booRadio = this;
            }
        };
    }

    function showFundamental(){
        var table=document.getElementById("classLevel0");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel1(){
        var table=document.getElementById("classLevel1");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel2(){
        var table=document.getElementById("classLevel2");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel3(){
        var table=document.getElementById("classLevel3");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel4(){
        var table=document.getElementById("classLevel4");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel5U(){
        var table=document.getElementById("classLevel5");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel5G(){
        var table=document.getElementById("classLevel6");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel6U(){
        var table=document.getElementById("classLevel7");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }function showLevel6G(){
        var table=document.getElementById("classLevel8");
        if(table.hasAttribute("hidden")){
            table.removeAttribute("hidden");
        }else{table.setAttribute("hidden","");}
    }
</script>
</body>


</html>
<?php
mysqli_close($conn);
?>
