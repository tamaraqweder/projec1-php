<?php

session_start();


$savedname=$_COOKIE["username"]??"";
//$_COOKIE["username"]??"" هاي بتجيب الاسم الي حفظناه في setcookie



//ال name
$name=$_POST["name"]?? "";
$name=trim($name);
//هذا المتغير عشان اخزن قيمه الايرور فيه
$nameError="";
if($_SERVER["REQUEST_METHOD"]=="POST"&& $name==""){
    $nameError="name is required";
}

//إذا المستخدم ما أرسل الفورم. هاي عشان الكوكيز
if($_SERVER["REQUEST_METHOD"]!=="POST"){
    $name=$savedname;
}


//بدنا نشتغل ع الايميل
$email=$_POST["email"] ?? "";
$email=trim($email);
$emailError="";
//ذا الإيميل فاضي والمستخدم أرسل الفورم
if($email=="" && $_SERVER["REQUEST_METHOD"]=="POST"){
    $emailError="email is reqired";
}
//إذا الإيميل مش فاضي، لكن صيغته غلط

elseif($email !="" && !filter_var($email,FILTER_VALIDATE_EMAIL)){
    $emailError="email is not valid";
}

//رقم الموبايل


$mobile=$_POST["mobile"] ?? "";
$mobile=trim($mobile);
$mobileError="";
if($mobile=="" && $_SERVER["REQUEST_METHOD"]=="POST"){
     $mobileError="the phone number required";
}
elseif($mobile !="" &&   !preg_match("/^[0-9]{10}$/", $mobile)){
    $mobileError ="phone number must be 10 digitals";
}

//لازم يختار govrnate
$governorate=$_POST["governorate"] ??"";
$governorateError="";
if($governorate=="" && $_SERVER["REQUEST_METHOD"]=="POST"){
    $governorateError="Please select a governorate";
}


//اختيار ال تراك
$track=$_POST["track"]??"";
$trackError="";
if($track=="" &&  $_SERVER["REQUEST_METHOD"]=="POST" ){
   $trackError="please choose track";
}

//اختيار المهارات وممكن تكون اكثر من مهاره بخزنهم في مصفوفه
$skills=$_POST["skills"]??[];
$skillError="";
//بما انه اعطينا ال skills مصفوفه فاضيه بستخدم ال empty
//يعني اذا كانت ال array فاضيه
if(empty($skills)&& $_SERVER["REQUEST_METHOD"]=="POST"){
     $skillError="at least one skill should be selected";
}


//عشان المسج
$message=$_POST["message"]??"";

//agree 
$agree=$_POST["agree"]??"";
$agreeError="";
if($agree=="" &&  $_SERVER["REQUEST_METHOD"]=="POST"){
    $agreeError="must be accepted";
}

//





$success="";
if($_SERVER["REQUEST_METHOD"]=="POST" &&
 $nameError == "" &&
    $emailError == "" &&
    $mobileError == "" &&
    $governorateError == "" &&
    $trackError == "" &&
    $skillError == "" &&
    $agreeError == "" 

)



{
     $success = "Registration completed successfully!";
      // "/" بتخلي الكوكيز محفوظه ع جميع مسارات الموقع
             setcookie("username",$name,time()+3600,"/");

     
         //create the object
               $regestration=new stdClass();  //انشأت اوبجكت اسمه تسجيل 
        //stdclass() نوع جاهز في PHP بنستخدمه لإنشاء Object بسيط.

         $regestration->name=$name;
         $regestration->email=$email;
         $regestration->mobile=$mobile;
         $regestration->governorate=$governorate;
         $regestration->track=$track;
         $regestration->skills=$skills;
         $regestration->message=$message;

              echo "name : " .htmlspecialchars($regestration->name);
               echo "<br>";
              echo "email : " . htmlspecialchars($regestration->email);
                 echo "<br>";
              echo "mobile : " .htmlspecialchars($regestration->mobile);
                            echo "<br>";

              echo "governate: " .htmlspecialchars($regestration->governorate);
                            echo "<br>";

              echo "track : " . htmlspecialchars($regestration->track);
                            echo "<br>";

              //implode عشان تحولها من مصفوفه الى نص
              echo "skills: " . htmlspecialchars(implode(", ", $regestration->skills));
                            echo "<br>";

             echo "message : " . htmlspecialchars($regestration->message);


             $_SESSION["regestration"]=$regestration;//هون يعني انا بدي اخزن الابوبجكت داخل الجلسه
            
}







?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
   <form action="" method="post">

  <label for="name">Full Name</label>
  <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name)?>">
  <span style="color:red;"> <?php  echo $nameError; ?></span>

  <label for="email">Email</label>
  <!--حوّل الرموز الخاصة إلى صيغة آمنة للعرض في HTML. -->
  <input type="email" id="email" name="email" value="<?php  echo htmlspecialchars($email)?>">
  <span style="color:red;"> <?php  echo $emailError ;?></span>

  <label for="mobile">Mobile</label>
  <input type="tel" id="mobile" name="mobile" placeholder="0791234567" value="<?php echo htmlspecialchars($mobile)   ?>">
   <span style="color:red;">   <?php echo $mobileError;?></span>


  <label for="governorate">Governorate</label>
  <select id="governorate" name="governorate">
    <option value="">Choose a governorate</option>
<!--عشان يحفظ كل قيمه احنا اخترناها-->
    <option value="Amman" <?php if($governorate=="Amman") echo "selected"; ?>> Amman</option>
    <option value="Irbid" <?php   if ($governorate=="Irbid") echo"selected";?>>Irbid</option>
    <option value="Aqaba" <?php   if($governorate =="Aqaba" ) echo "selected";?>>Aqaba</option>
    <option value="Zarqa" <?php if($governorate=="Zarqa") echo "selected";?>>Zarqa</option>
  </select>
    <span style="color:red;"> <?php  echo $governorateError; ?></span>


  <label>Track</label>

  <label class="inline">
    <input type="radio" name="track" value="Full Stack"  <?php   if($track=="Full Stack") echo "checked"; ?>>
    Full Stack
  </label>

  <label class="inline">
    <input type="radio" name="track" value="Frontend" <?php   if($track=="Frontend") echo "checked"; ?>>
    Frontend
  </label>

  <label class="inline">
    <input type="radio" name="track" value="Backend" <?php   if($track=="Backend") echo "checked"; ?>>
    Backend
  </label>

  <span style="color:red;"> <?php echo  $trackError;?></span>

  <label>Skills you already have</label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="HTML" <?php if(in_array("HTML",$skills)) echo "checked" ;?>>
    HTML
  </label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="CSS" <?php  if(in_array("CSS",$skills)) echo "checked";?>>
    CSS
  </label>

  <label class="inline">
    <input type="checkbox" name="skills[]" value="JavaScript" <?php if(in_array("JavaScript",$skills)) echo "checked";?>>
    JavaScript
  </label>

  <span style="color:red;">   <?php  echo  $skillError; ?></span>

  <label for="message">Why do you want to join? (optional)</label>
  <textarea id="message" name="message" rows="4"> <?php echo htmlspecialchars($message);?></textarea>

  <label class="inline terms">
    <input type="checkbox" name="agree" <?php if($agree=="on") echo "checked";?>>
    I agree to the academy terms
  </label>
  <span style="color:red;"><?php echo $agreeError;?></span>

  <button type="submit">Register</button>
  <p><?php echo $success; ?></p>



  

</form>


</body>
</html>