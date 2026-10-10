<?php
session_start();
//يعني رجع الاوبجكت من الsession 
$regestration = $_SESSION["regestration"];

//هل هذا المفتاح regestration موجود في session 

if(isset($_SESSION["regestration"])){

        echo $regestration->name;
        echo "<br>";
        echo $regestration->email;
                echo "<br>";

        echo $regestration->mobile;
                echo "<br>";

        echo $regestration->governorate;
                echo "<br>";

       echo  $regestration->track;
               echo "<br>";
      echo implode(", ", $regestration->skills);
                echo "<br>";

        echo $regestration->message;
}
else{
    echo "No registration data found";
}
?>